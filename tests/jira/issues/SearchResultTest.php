<?php
namespace tests\jira\issues;

use Dotenv\Dotenv;
use extas\components\extensions\Extension;
use extas\components\extensions\jira\fields\ExtensionNativeFields;
use extas\components\extensions\jira\fields\ExtensionProject;
use extas\components\jira\results\issues\SearchResult;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\interfaces\extensions\jira\fields\IExtensionNativeFields;
use extas\interfaces\extensions\jira\fields\IExtensionProject;
use extas\interfaces\jira\ISchemaItem;
use extas\interfaces\jira\issues\fields\IProject;
use extas\interfaces\jira\issues\IIssue;
use PHPUnit\Framework\TestCase;

/**
 * Class IssuesTest
 *
 * @package tests\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
class SearchResultTest extends TestCase
{
    use TSnuffRepositoryDynamic;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->createSnuffDynamicRepositories([]);
        $this->createWithSnuffRepo('extensionRepository', new Extension([
            Extension::FIELD__CLASS => ExtensionNativeFields::class,
            Extension::FIELD__INTERFACE => IExtensionNativeFields::class,
            Extension::FIELD__SUBJECT => 'extas.jira.issue.field',
            Extension::FIELD__METHODS => [
                'getFieldId', 'getFieldKey', 'getFieldName', 'getFieldSelf',
                'getFieldProjectTypeKey', 'getFieldAvatarUrls'
            ]
        ]));
    }

    public function testIssuesEnriching()
    {
        $result = new SearchResult([
            SearchResult::FIELD__ISSUES => [
                [
                    IIssue::FIELD__ID => 1,
                    IIssue::FIELD__KEY => 'JRK-1',
                    IIssue::FIELD__SELF => '',
                    IIssue::FIELD__FIELDS => [
                        'customfield__1290' => 'Is ok',
                        'project' => [
                            "self" => "https://some.url/rest/api/2/project/10114",
                            "id" => "10114",
                            "key" => "JRK",
                            "name" => "Jeyroik Project",
                            "projectTypeKey" => "software",
                            "avatarUrls" => [
                                "48x48" => "https://some.url/secure/projectavatar?pid=10114&avatarId=10657",
                                "24x24" => "https://some.url/secure/projectavatar?size=small&pid=10114&avatarId=10657",
                                "16x16" => "https://some.url/secure/projectavatar?size=xsmall&pid=10114&avatarId=10657",
                                "32x32" => "https://some.url/secure/projectavatar?size=medium&pid=10114&avatarId=10657"
                            ]
                        ]
                    ]
                ]
            ],
            SearchResult::FIELD__NAMES => [
                'customfield__1290' => 'Test',
                'project' => 'Project'
            ],
            SearchResult::FIELD__SCHEMA => [
                'customfield__1290' => [
                    ISchemaItem::FIELD__TYPE => 'string',
                    ISchemaItem::FIELD__CUSTOM => '',
                    ISchemaItem::FIELD__CUSTOM_ID => 1290
                ],
                'project' => [
                    ISchemaItem::FIELD__TYPE => "project",
			        ISchemaItem::FIELD__SYSTEM => "project"
                ]
            ]
        ]);

        $issues = $result->getIssues();
        $this->assertCount(1, $issues);
        $issue = array_shift($issues);
        $fields = $issue->getFields();

        foreach ($fields as $field) {
            $this->assertNotEmpty($field->getName(), 'Missed field name');
            if ($field->getName() == 'project') {
                $this->assertEquals(
                    'Project',
                    $field->getTitle(),
                    'Missed field "project" title'
                );
                $this->assertEquals(
                    'Project',
                    $field->getDescription(),
                    'Missed field "project" title'
                );
                $this->assertNotEmpty($field->getSchema(), 'Missed "project" schema');
                $this->assertEquals(
                    [
                        ISchemaItem::FIELD__TYPE => "project",
                        ISchemaItem::FIELD__SYSTEM => "project"
                    ],
                    $field->getSchema()->__toArray()
                );
                /**
                 * @var IProject $field
                 */
                $this->assertEquals(
                    'https://some.url/rest/api/2/project/10114',
                    $field->getFieldSelf(),
                    'Incorrect "project" self: ' . print_r($field->__toArray(), true)
                );
                $this->assertEquals(
                    10114,
                    $field->getFieldId(),
                    'Incorrect "project" id: ' . print_r($field->__toArray(), true)
                );
                $this->assertEquals(
                    'JRK',
                    $field->getFieldKey(),
                    'Incorrect "project" key: ' . print_r($field->__toArray(), true)
                );
                $this->assertEquals(
                    'Jeyroik Project',
                    $field->getFieldName(),
                    'Incorrect "project" name: ' . print_r($field->__toArray(), true)
                );
                $this->assertEquals(
                    'software',
                    $field->getFieldProjectTypeKey(),
                    'Incorrect "project" type key: ' . print_r($field->__toArray(), true)
                );
                $this->assertEquals(
                    [
                        "48x48" => "https://some.url/secure/projectavatar?pid=10114&avatarId=10657",
                        "24x24" => "https://some.url/secure/projectavatar?size=small&pid=10114&avatarId=10657",
                        "16x16" => "https://some.url/secure/projectavatar?size=xsmall&pid=10114&avatarId=10657",
                        "32x32" => "https://some.url/secure/projectavatar?size=medium&pid=10114&avatarId=10657"
                    ],
                    $field->getFieldAvatarUrls(),
                    'Incorrect "project" avatar urls: ' . print_r($field->getFieldAvatarUrls(), true)
                );
            } else {
                $this->assertEquals(
                    'Test',
                    $field->getTitle(),
                    'Missed field "test" title'
                );
                $this->assertEquals(
                    'Test',
                    $field->getDescription(),
                    'Missed field "test" title'
                );
                $this->assertNotEmpty($field->getSchema(), 'Missed "test" schema');
                $this->assertEquals(
                    [
                        ISchemaItem::FIELD__TYPE => 'string',
                        ISchemaItem::FIELD__CUSTOM => '',
                        ISchemaItem::FIELD__CUSTOM_ID => 1290
                    ],
                    $field->getSchema()->__toArray()
                );
                $this->assertEquals(
                    'Is ok',
                    $field->getParameterValue('value'),
                    'Incorrect value of "test"'
                );
            }
        }
    }

    public function testSkipEnrichIssues()
    {
        $result = new SearchResult([
            SearchResult::FIELD__ISSUES => [1,2,3],
            SearchResult::FIELD__IS_ENRICH_ISSUES => false
        ]);

        $this->assertEquals([1,2,3], $result[SearchResult::FIELD__ISSUES]);
    }
}
