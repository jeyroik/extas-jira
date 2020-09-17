<?php
namespace tests\jira\issues;

use Dotenv\Dotenv;
use extas\components\extensions\Extension;
use extas\components\extensions\jira\fields\ExtensionProject;
use extas\components\jira\results\issues\SearchResult;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\interfaces\extensions\jira\fields\IExtensionProject;
use extas\interfaces\jira\ISchemaItem;
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
            Extension::FIELD__CLASS => ExtensionProject::class,
            Extension::FIELD__INTERFACE => IExtensionProject::class,
            Extension::FIELD__SUBJECT => 'extas.jira.issue.field',
            Extension::FIELD__METHODS => [
                'getProjectId', 'getProjectKey', 'getProjectName', 'getProjectSelf',
                'getProjectTypeKey', 'getProjectAvatarUrls'
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
                 * @var IExtensionProject $field
                 */
                $this->assertEquals(
                    'https://some.url/rest/api/2/project/10114',
                    $field->getProjectSelf(),
                    'Incorrect "project" self: ' . $field->getProjectSelf()
                );
                $this->assertEquals(
                    10114,
                    $field->getProjectId(),
                    'Incorrect "project" id: ' . $field->getProjectId()
                );
                $this->assertEquals(
                    'JRK',
                    $field->getProjectKey(),
                    'Incorrect "project" key: ' . $field->getProjectKey()
                );
                $this->assertEquals(
                    'Jeyroik Project',
                    $field->getProjectName(),
                    'Incorrect "project" name: ' . $field->getProjectName()
                );
                $this->assertEquals(
                    'software',
                    $field->getProjectTypeKey(),
                    'Incorrect "project" type key: ' . $field->getProjectTypeKey()
                );
                $this->assertEquals(
                    [
                        "48x48" => "https://some.url/secure/projectavatar?pid=10114&avatarId=10657",
                        "24x24" => "https://some.url/secure/projectavatar?size=small&pid=10114&avatarId=10657",
                        "16x16" => "https://some.url/secure/projectavatar?size=xsmall&pid=10114&avatarId=10657",
                        "32x32" => "https://some.url/secure/projectavatar?size=medium&pid=10114&avatarId=10657"
                    ],
                    $field->getProjectAvatarUrls(),
                    'Incorrect "project" avatar urls: ' . print_r($field->getProjectAvatarUrls(), true)
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
}
