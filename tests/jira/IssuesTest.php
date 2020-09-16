<?php
namespace tests\jira;

use Dotenv\Dotenv;
use extas\components\extensions\Extension;
use extas\components\extensions\jira\ExtensionJiraRepositories;
use extas\components\extensions\jira\jql\ExtensionIn;
use extas\components\extensions\jira\uri\ExtensionExpand;
use extas\components\http\TSnuffHttp;
use extas\components\Item;
use extas\components\jira\issues\Issue;
use extas\components\jira\Jql;
use extas\components\jira\SchemaItem;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\secrets\resolvers\ResolverPhpEncryption;
use extas\components\secrets\Secret;
use extas\components\THasMagicClass;
use extas\interfaces\extensions\jira\IExtensionJiraRepositories;
use extas\interfaces\extensions\jira\jql\IExtensionIn;
use extas\interfaces\extensions\jira\uri\IExtensionExpand;
use extas\interfaces\jira\IJIraRepository;
use extas\interfaces\jira\IJql;
use extas\interfaces\jira\issues\IIssue;
use extas\interfaces\jira\issues\IIssues;
use extas\interfaces\jira\results\issues\ISearchResult;
use extas\interfaces\samples\parameters\ISampleParameter;
use PHPUnit\Framework\TestCase;
use tests\jira\misc\HttpClient;

class IssuesTest extends TestCase
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
    }

    public function testDefaultOrderBy()
    {
        $item = $this->getSearchItem();

        $issues = $item->find([]);
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

    protected function getSearchItem()
    {
        return new class ([
            'test' => $this
        ]) extends Item {
            public function find(array $orderBy = ['id', 1]): ISearchResult
            {
                /**
                 * @var IExtensionIn|IJql $jql
                 */
                $jql = new Jql();
                $jql->andCondition('test', '=', '"is ok"')
                    ->andIn('assignee', ['jeyroik', 'test']);

                /**
                 * @var IJIraRepository $repo
                 */
                $repo = $this->jiraIssues('test', 'test');

                $this->test->assertEmpty($repo->getPk(), 'PK is not empty: ' . $repo->getPk());
                $this->test->assertEquals(
                    Issue::class,
                    $repo->getItemClass(),
                    'Incorrect issue class: ' . $repo->getItemClass()
                );

                return $repo->all($jql, 1, 1, $orderBy, ['operations', 'names']);
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
