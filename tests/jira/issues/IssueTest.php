<?php
namespace tests\jira\issues;

use Dotenv\Dotenv;
use extas\components\extensions\Extension;
use extas\components\extensions\jira\ExtensionJiraRepositories;
use extas\components\extensions\jira\fields\ExtensionNativeFields;
use extas\components\extensions\jira\jql\ExtensionIn;
use extas\components\extensions\jira\uri\ExtensionExpand;
use extas\components\http\TSnuffHttp;
use extas\components\Item;
use extas\components\jira\issues\fields\IssueLink;
use extas\components\jira\issues\Issue;
use extas\components\jira\issues\IssueRepository;
use extas\components\jira\Jql;
use extas\components\jira\SchemaItem;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\secrets\resolvers\ResolverPhpEncryption;
use extas\components\secrets\Secret;
use extas\components\THasMagicClass;
use extas\interfaces\extensions\jira\fields\IExtensionNativeFields;
use extas\interfaces\extensions\jira\fields\IHasFieldIssueLinks;
use extas\interfaces\extensions\jira\IExtensionJiraRepositories;
use extas\interfaces\extensions\jira\jql\IExtensionIn;
use extas\interfaces\extensions\jira\uri\IExtensionExpand;
use extas\interfaces\jira\IJIraRepository;
use extas\interfaces\jira\IJql;
use extas\interfaces\jira\issues\changelog\IHistoryItem;
use extas\interfaces\jira\issues\fields\IAggregateProgress;
use extas\interfaces\jira\issues\fields\IAggregateTimeEstimate;
use extas\interfaces\jira\issues\fields\IAggregateTimeOriginalEstimate;
use extas\interfaces\jira\issues\fields\IAggregateTimeSpent;
use extas\interfaces\jira\issues\fields\IAssignee;
use extas\interfaces\jira\issues\fields\ICreated;
use extas\interfaces\jira\issues\fields\ICreator;
use extas\interfaces\jira\issues\fields\IDescription;
use extas\interfaces\jira\issues\fields\IDueDate;
use extas\interfaces\jira\issues\fields\IField;
use extas\interfaces\jira\issues\fields\IIssueLinks;
use extas\interfaces\jira\issues\fields\IIssueType;
use extas\interfaces\jira\issues\fields\ILabels;
use extas\interfaces\jira\issues\fields\IPriority;
use extas\interfaces\jira\issues\fields\IProgress;
use extas\interfaces\jira\issues\fields\IProject;
use extas\interfaces\jira\issues\fields\IReporter;
use extas\interfaces\jira\issues\fields\IStatus;
use extas\interfaces\jira\issues\fields\ISummary;
use extas\interfaces\jira\issues\fields\ITimeEstimate;
use extas\interfaces\jira\issues\fields\ITimeOriginalEstimate;
use extas\interfaces\jira\issues\fields\ITimeSpent;
use extas\interfaces\jira\issues\fields\IUpdated;
use extas\interfaces\jira\issues\fields\IWorkRatio;
use extas\interfaces\jira\issues\IIssue;
use extas\interfaces\jira\issues\changelog\IHistory;
use extas\interfaces\jira\results\issues\ISearchResult;
use extas\interfaces\samples\parameters\ISampleParameter;
use PHPUnit\Framework\TestCase;
use tests\jira\misc\HttpClient;

/**
 * Class IssueTest
 *
 * @package tests\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
class IssueTest extends TestCase
{
    use TSnuffRepositoryDynamic;
    use THasMagicClass;
    use TSnuffHttp;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->createSnuffDynamicRepositories([
            ['secrets', 'name', Secret::class]
        ]);

        $this->createInstanceDataSecret();
        $this->installRepositoriesExtension();
        $this->installJqlExtensions();
        $this->installUriExtensions();
        $this->settHttpClient();
    }

    protected function tearDown(): void
    {
        $this->deleteSnuffDynamicRepositories();
    }

    public function testOneIssue()
    {
        $item = $this->getSearchItem();

        $issues = $item->find();
        $this->assertNotEmpty($issues, 'Can not extract issues');
        $this->assertEquals(
            1,
            $issues->getMaxResults(),
            'Incorrect issues number: ' . print_r($issues->getMaxResults(), true)
        );
        $this->assertEquals(
            1,
            $issues->getStartAt(),
            'Incorrect start at: ' . $issues->getStartAt()
        );

        foreach ($issues as $issue) {
            $this->assertInstanceOf(
                Issue::class,
                $issue,
                'Incorrect issue: ' . print_r($issue, true)
            );
        }

        $issues->rewind();
        $issue = $issues->current();
        $this->assertEquals('JRK-1', $issue->getKey(), 'Incorrect issue key: ' . $issue->getKey());
        $this->assertEquals(
            [
                'operations',
                'versionedrepresentations',
                'editmeta',
                'changelog',
                'renderedfields'
            ],
            $issue->getExpand(),
            'Incorrect expand: ' . print_r($issue->getExpand(), true)
        );
        $this->assertEquals(
            'https://some.url/rest/api/2/search?'
            . 'jql=' . urlencode('(test = "is ok") and (assignee in (jeyroik,test)) ORDER BY id asc')
            . '&startAt=1'
            . '&maxResults=1'
            . '&expand=operations,names',
            $issue->getSelf(),
            'Incorrect uri: ' . $issue->getSelf()
        );
        $this->assertEquals(
            [
                'customfield_1290' => 'Test'
            ],
            $issues->getNames(),
            'Incorrect names: ' . print_r($issues->getNames(), true)
        );
        $this->assertTrue(
            $issues->hasName('customfield_1290'),
            'Missed name for the customfield_1290'
        );
        $this->assertEquals(
            'Test',
            $issues->getName('customfield_1290'),
            'Incorrect name for the customfield_1290: ' . $issues->getName('customfield_1290')
        );
        $this->assertEquals(
            [
                'customfield_1290' => new SchemaItem([
                    'type' => 'string',
                    'custom' => 'com.atlassian.jira.plugin.system.customfieldtypes:textfield',
                    'customId' => 11200
                ])
            ],
            $issues->getSchema(),
            'Incorrect names: ' . print_r($issues->getSchema(), true)
        );

        $schemaItems = $issues->getSchema();
        $schemaItem = array_shift($schemaItems);
        $this->assertEquals(
            11200,
            $schemaItem->getCustomId(),
            'Incorrect custom id: ' . $schemaItem->getCustomId()
        );
        $this->assertEquals(
            'com.atlassian.jira.plugin.system.customfieldtypes:textfield',
            $schemaItem->getCustom(),
            'Incorrect custom: ' . $schemaItem->getCustom()
        );
        $this->assertEquals(
            '',
            $schemaItem->getSystem(),
            'Incorrect system: ' . $schemaItem->getSystem()
        );
        $this->assertTrue(
            $schemaItem->isTypeOf('string'),
            'Incorrect type: ' . $schemaItem->getType()
        );
        $this->assertEmpty(
            $schemaItem->getItems(),
            'Incorrect items: ' . $schemaItem->getItems()
        );
    }

    public function testDefaultOrderBy()
    {
        $item = $this->getSearchItem();

        $issues = $item->find([], true);
        $issue = $issues->current();
        $this->assertEquals(
            'https://some.url/rest/api/2/search?'
            . 'jql=' . urlencode('(test = "is ok") and (assignee in (jeyroik,test)) ORDER BY id desc')
            . '&startAt=1'
            . '&maxResults=1'
            . '&expand=operations,names',
            $issue->getSelf(),
            'Incorrect uri: ' . $issue->getSelf()
        );
    }

    public function testMissedSecret()
    {
        $this->getMagicClass('secrets')->drop();
        $item = $this->getSearchItem();

        $this->expectExceptionMessage('Missed or unknown Jira instance "test" secret');
        $item->find([]);
    }

    public function testIncorrectSecret()
    {
        $this->getMagicClass('secrets')->drop();
        $this->createInstanceDataSecret(false);
        $item = $this->getSearchItem();

        $this->expectExceptionMessage('Can not decrypt Jira instance "test" config');
        $item->find([]);
    }

    public function testFieldsExtensions()
    {
        $this->createWithSnuffRepo('extensionRepository', new Extension([
            Extension::FIELD__CLASS => ExtensionNativeFields::class,
            Extension::FIELD__INTERFACE => IExtensionNativeFields::class,
            Extension::FIELD__SUBJECT => 'extas.jira.issue.field',
            Extension::FIELD__METHODS => [
                'getFieldId', 'getFieldKey', 'getFieldName', 'getFieldSelf',
                'getFieldProjectTypeKey', 'getFieldAvatarUrls',
                'getFieldIconUrl', 'getFieldValue', 'getFieldEmailAddress',
                'getFieldDisplayName', 'getFieldActive', 'getFieldTimeZone',
                'getFieldStatusCategory', 'getFieldProgress', 'getFieldTotal',
                'getFieldPercent', 'getFieldAvatarId', 'getFieldSubtask',
                'getFieldLinkType', 'getFieldInwardIssue', 'getFieldOutwardIssue',
                'getFieldLinks', 'getFieldDescription'
            ]
        ]));

        $data = json_decode(file_get_contents(getcwd() . '/tests/jira/misc/issue.json'), true);
        $issue = new Issue($data);

        $this->fieldProgress($issue, IAggregateProgress::NAME);
        $this->fieldAggregateTimeEstimate($issue);
        $this->fieldAggregateTimeOriginalEstimate($issue);
        $this->fieldAggregateTimeSpent($issue);
        $this->fieldAssignee($issue);
        $this->fieldCreated($issue);
        $this->fieldCreator($issue);
        $this->fieldDescription($issue);
        $this->fieldDueDate($issue);
        $this->fieldIssueLinks($issue);
        $this->fieldIssueType($issue);
        $this->fieldLabels($issue);
        $this->fieldPriority($issue);
        $this->fieldProgress($issue);
        $this->fieldProject($issue);
        $this->fieldReporter($issue);
        $this->fieldStatus($issue);
        $this->fieldSummary($issue);
        $this->fieldTimeEstimate($issue);
        $this->fieldTimeOriginalEstimate($issue);
        $this->fieldTimeSpent($issue);
        $this->fieldUpdated($issue);
        $this->fieldWorkRatio($issue);
    }

    public function testChangelog()
    {
        $this->createWithSnuffRepo('extensionRepository', new Extension([
            Extension::FIELD__CLASS => ExtensionNativeFields::class,
            Extension::FIELD__INTERFACE => IExtensionNativeFields::class,
            Extension::FIELD__SUBJECT => 'extas.jira.issue.field',
            Extension::FIELD__METHODS => ['getFieldValue']
        ]));

        $data = json_decode(file_get_contents(getcwd() . '/tests/jira/misc/issue.json'), true);
        $issue = new Issue($data);

        $changelog = $issue->getChangelog();

        $this->assertNotEmpty(
            $changelog,
            'Can not find changelog'
        );

        $histories = $changelog->getHistory();
        $this->assertCount(
            20,
            $histories,
            'Incorrect histories count: ' . count($histories)
        );

        $item = $changelog->one([
            'author.name' => 'jeyroik',
            'items' => ['field' => 'Link']
        ]);

        $this->assertNotEmpty(
            $item,
            'Can not find one history with items condition'
        );
        $this->assertInstanceOf(IHistory::class, $item, 'incorrect history instance');
        $this->assertInstanceOf(
            IField::class,
            $item->getAuthor(),
            'Incorrect author'
        );
        $this->assertEquals(
            '2020-08-14T14:27:09.011+0300',
            $item->getCreated()->getFieldValue(),
            'Incorrect created'
        );

        $item = $changelog->one([
            'author.name' => 'jeyroik',
            'items' => ['field' => 'unknown']
        ]);

        $this->assertEmpty($item, 'Incorrect search results by history with items condition');

        $subItem = $changelog->oneItem([
            'author.name' => 'jeyroik',
            'items' => ['field' => 'Link']
        ]);

        $this->assertNotEmpty($subItem, 'Can not find sub item');
        $this->assertInstanceOf(IHistoryItem::class, $subItem, 'Incorrect sub item instance');

        $this->assertEquals(
            'Link',
            $subItem->getField(),
            'Incorrect "field": ' . print_r($subItem, true)
        );
        $this->assertEquals(
            'jira',
            $subItem->getFieldType(),
            'Incorrect "field type": ' . print_r($subItem, true)
        );
        $this->assertEquals(
            null,
            $subItem->getFrom(),
            'Incorrect "from": ' . print_r($subItem, true)
        );
        $this->assertEquals(
            null,
            $subItem->getFromString(),
            'Incorrect "from string": ' . print_r($subItem, true)
        );
        $this->assertEquals(
            'JRK-50',
            $subItem->getTo(),
            'Incorrect "to": ' . print_r($subItem, true)
        );
        $this->assertEquals(
            'This issue is Child of JRK-50',
            $subItem->getToString(),
            'Incorrect "to string": ' . print_r($subItem, true)
        );

        $subItem = $changelog->oneItem([
            'author.name' => 'jeyroik',
            'items' => ['field' => 'Unknown']
        ]);
        $this->assertEmpty($subItem, 'Incorrect search result by history items');

        $items = $changelog->all([
            'author.name' => 'jeyroik',
            'items' => ['field' => 'Link']
        ]);

        $this->assertCount(1, $items, 'Incorrect items count: ' . count($items));

        $subItems = $changelog->allItems([
            'author.name' => 'jeyroik',
            'items' => ['field' => 'Link']
        ]);

        $this->assertCount(1, $items, 'Incorrect items count: ' . count($subItems));

        $subItems = $changelog->allItems([
            'author.name' => 'jeyroik'
        ]);

        $this->assertCount(4, $subItems, 'Incorrect items count: ' . count($subItems));
    }

    protected function fieldAggregateTimeEstimate(IIssue $issue)
    {
        $this->fieldWithValue($issue, IAggregateTimeEstimate::NAME, 110);
    }

    protected function fieldAggregateTimeOriginalEstimate(IIssue $issue)
    {
        $this->fieldWithValue($issue, IAggregateTimeOriginalEstimate::NAME, 110);
    }

    protected function fieldAggregateTimeSpent(IIssue $issue)
    {
        $this->fieldWithValue($issue, IAggregateTimeSpent::NAME, 110);
    }

    protected function fieldAssignee(IIssue $issue)
    {
        $this->fieldWithuser($issue, IAssignee::NAME);
    }

    protected function fieldCreated(IIssue $issue)
    {
        $this->fieldWithValue($issue, ICreated::NAME, '2020-08-14T14:27:08.000+0300');
    }

    protected function fieldCreator(IIssue $issue)
    {
        $this->fieldWithuser($issue, ICreator::NAME);
    }

    protected function fieldDescription(IIssue $issue)
    {
        $this->fieldWithValue($issue, IDescription::NAME, 'test');
    }

    protected function fieldDueDate(IIssue $issue)
    {
        $this->fieldWithValue($issue, IDueDate::NAME, '2020-08-14T14:27:08.000+0300');
    }

    protected function fieldIssueLinks(IIssue $issue)
    {
        $this->assertTrue(
            $issue->hasField(IIssueLinks::NAME),
            'Can not find "' . IIssueLinks::NAME . '" field: ' . print_r($issue->__toArray(), true)
        );

        /**
         * @var IHasFieldIssueLinks $field
         */
        $field = $issue->getField(IIssueLinks::NAME);
        $links = $field->getFieldLinks();
        $this->assertNotEmpty($links, 'Missed issue links: ' . print_r($field->__toArray(), true));
        $link = array_shift($links);
        $this->assertInstanceOf(
            IssueLink::class,
            $link,
            'Incorrect link instance: ' . get_class($link)
        );
        $this->assertEquals(
            'is Child of',
            $link->getFieldLinkType()->getInward(),
            'Incorrect inward: ' . print_r($link->__toArray(), true)
        );
        $this->assertEquals(
            'is Parent of',
            $link->getFieldLinkType()->getOutward(),
            'Incorrect outward: ' . $link->getFieldLinkType()->getOutward()
        );
        $this->assertNotEmpty(
            $link->getFieldOutwardIssue(),
            'Missed outward issue: ' . print_r($link->__toArray(), true)
        );
        $this->assertNotEmpty(
            $link->getFieldInwardIssue(),
            'Missed inward issue: ' . print_r($link->__toArray(), true)
        );
    }

    protected function fieldIssueType(IIssue $issue)
    {
        $this->assertTrue(
            $issue->hasField(IIssueType::NAME),
            'Can not find "' . IIssueType::NAME . '" field: ' . print_r($issue->__toArray(), true)
        );

        /**
         * @var IIssueType $type
         */
        $type = $issue->getField(IIssueType::NAME);
        $this->assertEquals(
            10318,
            $type->getFieldAvatarId(),
            'Incorrect issue type avatar id: ' . print_r($type->__toArray(), true)
        );
        $this->assertFalse(
            $type->getFieldSubtask(),
            'Incorrect issue type subtask: ' . print_r($type->__toArray(), true)
        );
    }

    protected function fieldLabels(IIssue $issue)
    {
        $this->assertTrue(
            $issue->hasField(ILabels::NAME),
            'Can not find "' . ILabels::NAME . '" field: ' . print_r($issue->__toArray(), true)
        );

        /**
         * @var ILabels $labels
         */
        $labels = $issue->getField(ILabels::NAME);
        $this->assertEquals(
            ['test', 'is ok'],
            $labels->getFieldValue(),
            'Incorrect labels value: ' . print_r($labels->__toArray(), true)
        );
    }

    protected function fieldPriority(IIssue $issue)
    {
        $this->assertTrue(
            $issue->hasField(IPriority::NAME),
            'Can not find "' . IPriority::NAME . '" field: ' . print_r($issue->__toArray(), true)
        );
        /**
         * @var IPriority|IField $priority
         */
        $priority = $issue->getField(IPriority::NAME);
        $this->assertEquals(
            'https://some.url/images/icons/priorities/medium.svg',
            $priority->getFieldIconUrl(),
            'Incorrect icon url: ' . print_r($priority->__toArray(), true)
        );
    }

    protected function fieldProgress(IIssue $issue, string $fieldName = IProgress::NAME)
    {
        $this->assertTrue(
            $issue->hasField($fieldName),
            'Can not find "' . $fieldName . '" field: ' . print_r($issue->__toArray(), true)
        );

        /**
         * @var IProgress $field
         */
        $field = $issue->getField($fieldName);
        $this->assertEquals(
            10500,
            $field->getFieldProgress(),
            'Incorrect ' . $fieldName . ' progress: ' . print_r($field->__toArray(), true)
        );
        $this->assertEquals(
            19500,
            $field->getFieldTotal(),
            'Incorrect ' . $fieldName . ' total: ' . print_r($field->__toArray(), true)
        );
        $this->assertEquals(
            53,
            $field->getFieldPercent(),
            'Incorrect ' . $fieldName . ' percent: ' . print_r($field->__toArray(), true)
        );
    }

    protected function fieldProject(IIssue $issue)
    {
        $this->assertTrue(
            $issue->hasField(IProject::NAME),
            'Can not find "' . IProject::NAME . '" field: ' . print_r($issue->__toArray(), true)
        );

        /**
         * @var IProject
         */
        $project = $issue->getField(IProject::NAME);

        $this->assertEquals(
            'software',
            $project->getFieldProjectTypeKey(),
            'Incorrect project type key: ' . $project->getFieldProjectTypeKey()
        );
    }

    protected function fieldReporter(IIssue $issue)
    {
        $this->fieldWithuser($issue, IReporter::NAME);
    }

    protected function fieldStatus(IIssue $issue)
    {
        $this->assertTrue(
            $issue->hasField(IStatus::NAME),
            'Can not find "' . IStatus::NAME . '" field: ' . print_r($issue->__toArray(), true)
        );

        /**
         * @var IStatus $status
         */
        $status = $issue->getField(IStatus::NAME);

        $this->assertEquals(
            'test',
            $status->getFieldDescription(),
            'incorrect status description: ' . print_r($status->__toArray(), true)
        );

        $category = $status->getFieldStatusCategory();
        $this->assertNotEmpty($category, 'Missed status category :' . print_r($status->__toArray(), true));
        $this->assertEquals(
            'yellow',
            $category->getFieldColorName(),
            'Incorrect status category color name: ' . print_r($category->__toArray(), true)
        );
        $this->assertEquals(
            [
                'self' => 'https://some.url/rest/api/2/statuscategory/4',
                'id' => 4,
                'key' => 'indeterminate',
                'colorName' => 'yellow',
                'name' => 'In Progress'
            ],
            $category->getParametersValues(),
            'Incorrect status category: ' . print_r($category->getParametersValues(), true)
        );
    }

    protected function fieldSummary(IIssue $issue)
    {
        $this->fieldWithValue($issue, ISummary::NAME, 'test');
    }

    protected function fieldTimeEstimate(IIssue $issue)
    {
        $this->fieldWithValue($issue, ITimeEstimate::NAME, 110);
    }

    protected function fieldTimeOriginalEstimate(IIssue $issue)
    {
        $this->fieldWithValue($issue, ITimeOriginalEstimate::NAME, 110);
    }

    protected function fieldTimeSpent(IIssue $issue)
    {
        $this->fieldWithValue($issue, ITimeSpent::NAME, 110);
    }

    protected function fieldUpdated(IIssue $issue)
    {
        $this->fieldWithValue($issue, IUpdated::NAME, '2020-08-14T14:27:08.000+0300');
    }

    protected function fieldWorkRatio(IIssue $issue)
    {
        $this->fieldWithValue($issue, IWorkRatio::NAME, 110);
    }

    protected function fieldWithuser(IIssue $issue, string $fieldName)
    {
        $this->assertTrue(
            $issue->hasField($fieldName),
            'Can not find "' . $fieldName . '" field: ' . print_r($issue->__toArray(), true)
        );
        /**
         * @var IAssignee|IField $assignee
         */
        $assignee = $issue->getField($fieldName);
        $this->assertEquals(
            'jeyroik@gmail.com',
            $assignee->getFieldEmailAddress(),
            'Incorrect ' . $fieldName . ' email address: ' . print_r($assignee->__toArray(), true)
        );
        $this->assertEquals(
            true,
            $assignee->getFieldActive(),
            'Incorrect ' . $fieldName . ' active: ' . print_r($assignee->__toArray(), true)
        );
        $this->assertEquals(
            'Jey Roik',
            $assignee->getFieldDisplayName(),
            'Incorrect ' . $fieldName . ' display name: ' . print_r($assignee->__toArray(), true)
        );
        $this->assertEquals(
            'Europe/Moscow',
            $assignee->getFieldTimeZone(),
            'Incorrect ' . $fieldName . ' time zone: ' . print_r($assignee->__toArray(), true)
        );
    }

    protected function fieldWithValue(IIssue $issue, string $fieldName, $value)
    {
        $this->assertTrue(
            $issue->hasField($fieldName),
            'Can not find "' . $fieldName . '" field: '
            . print_r($issue->__toArray(), true)
        );

        $field = $issue->getField($fieldName);
        $this->assertEquals(
            $value,
            $field->getFieldValue(),
            'Incorrect ' . $fieldName . ' value: ' . $field->getFieldValue()
        );
    }

    protected function getSearchItem()
    {
        return new class ([
            'test' => $this
        ]) extends Item {
            public function find(array $orderBy = ['id', 1], bool $isOne = false): ISearchResult
            {
                /**
                 * @var IExtensionIn|IJql $jql
                 */
                $jql = new Jql();
                $jql->andCondition('test', '=', '"is ok"')
                    ->andIn('assignee', ['jeyroik', 'test']);

                /**
                 * @var IssueRepository $repo
                 */
                $repo = $this->jiraIssues('test', 'test');

                $this->test->assertEmpty($repo->getPk(), 'PK is not empty: ' . $repo->getPk());
                $this->test->assertEquals(
                    Issue::class,
                    $repo->getItemClass(),
                    'Incorrect issue class: ' . $repo->getItemClass()
                );

                return $isOne
                    ? $repo->one($jql, 1, ['operations', 'names'])
                    : $repo->all($jql, 1, 1, $orderBy, ['operations', 'names']);
            }

            protected function getSubjectForExtension(): string
            {
                return 'test.item';
            }
        };
    }

    protected function settHttpClient(): void
    {
        $this->addReposForExt([
            'httpClient' => HttpClient::class
        ]);
    }

    protected function installUriExtensions(): void
    {
        $this->createWithSnuffRepo('extensionRepository', new Extension([
            Extension::FIELD__CLASS => ExtensionExpand::class,
            Extension::FIELD__INTERFACE => IExtensionExpand::class,
            Extension::FIELD__SUBJECT => 'extas.jira.uri',
            Extension::FIELD__METHODS => ['expand']
        ]));
    }

    protected function installJqlExtensions(): void
    {
        $this->createWithSnuffRepo('extensionRepository', new Extension([
            Extension::FIELD__CLASS => ExtensionIn::class,
            Extension::FIELD__INTERFACE => IExtensionIn::class,
            Extension::FIELD__SUBJECT => 'extas.jira.jql',
            Extension::FIELD__METHODS => ['andIn']
        ]));
    }

    protected function installRepositoriesExtension(): void
    {
        $this->createWithSnuffRepo('extensionRepository', new Extension([
            Extension::FIELD__CLASS => ExtensionJiraRepositories::class,
            Extension::FIELD__INTERFACE => IExtensionJiraRepositories::class,
            Extension::FIELD__SUBJECT => '*',
            Extension::FIELD__METHODS => ['jiraIssues']
        ]));
    }

    protected function createInstanceDataSecret(bool $encrypt = true): void
    {
        $secret = new Secret([
            Secret::FIELD__TARGET => IJIraRepository::SERVICE__NAME,
            Secret::FIELD__NAME => 'test',
            Secret::FIELD__CLASS => ResolverPhpEncryption::class,
            Secret::FIELD__VALUE => json_encode([
                'credentials' => ['test_login', 'test_password'],
                'base_url' => 'https://some.url/'
            ]),
            Secret::FIELD__PARAMETERS => [
                ResolverPhpEncryption::PARAM__PASSWORD => [
                    ISampleParameter::FIELD__NAME => ResolverPhpEncryption::PARAM__PASSWORD,
                    ISampleParameter::FIELD__VALUE => 'test'
                ]
            ]
        ]);
        $encrypt && $secret->encrypt();
        $this->getMagicClass('secrets')->create($secret);
    }
}
