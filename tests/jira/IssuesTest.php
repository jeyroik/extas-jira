<?php
namespace tests\jira;

use Dotenv\Dotenv;
use extas\components\extensions\Extension;
use extas\components\extensions\jira\ExtensionJiraRepositories;
use extas\components\extensions\jira\jql\ExtensionIn;
use extas\components\http\TSnuffHttp;
use extas\components\Item;
use extas\components\jira\Jql;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\secrets\resolvers\ResolverPhpEncryption;
use extas\components\secrets\Secret;
use extas\components\THasMagicClass;
use extas\interfaces\extensions\jira\IExtensionJiraRepositories;
use extas\interfaces\extensions\jira\jql\IExtensionIn;
use extas\interfaces\jira\IJIraRepository;
use extas\interfaces\jira\IJql;
use extas\interfaces\jira\issues\IIssue;
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
        $this->settHttpClient();
    }

    protected function tearDown(): void
    {
        $this->deleteSnuffDynamicRepositories();
    }

    public function testOneIssue()
    {
        $item = new class extends Item {
            public function find()
            {
                /**
                 * @var IExtensionIn|IJql $jql
                 */
                $jql = new Jql();
                $jql->andCondition('test', '=', '"is ok"')
                    ->andIn('assignee', ['jeyroik', 'test']);

                return $this->jiraIssues('test', 'test')->all($jql, 1, 1);
            }

            protected function getSubjectForExtension(): string
            {
                return 'test.item';
            }
        };

        $issues = $item->find();
        $this->assertNotEmpty($issues, 'Can not extract issues');

        $this->assertCount(
            1,
            $issues,
            'Incorrect issues number: ' . print_r($issues, true)
        );

        /**
         * @var IIssue $issue
         */
        $issue = array_shift($issues);
        $this->assertEquals(
            'https://some.url/rest/api/2/search?'
            . 'jql=(test = "is ok") and (assignee in (jeyroik,test))'
            .'&startAt=1'
            .'&maxResults=1',
            $issue->getSelf(),
            'Incorrect uri: ' . $issue->getSelf()
        );
    }

    protected function settHttpClient(): void
    {
        $this->addReposForExt([
            'httpClient' => HttpClient::class
        ]);
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

    protected function createInstanceDataSecret(): void
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
        $secret->encrypt();
        $this->getMagicClass('secrets')->create($secret);
    }
}
