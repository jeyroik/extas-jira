<?php
namespace tests\jira;

use Dotenv\Dotenv;
use extas\components\jira\JiraRepository;
use extas\components\plugins\PluginEmpty;
use extas\interfaces\jira\IJIraRepository;
use extas\interfaces\repositories\IRepository;
use PHPUnit\Framework\TestCase;

/**
 * Class JiraRepositoryTest
 *
 * @package tests\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
class JiraRepositoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
    }

    public function testResults()
    {
        $repo = $this->getRepo();
        $data = ['test' => 'is ok'];

        $result = $repo->deleteResult($data);
        $this->assertInstanceOf(PluginEmpty::class, $result);
        $this->assertEquals(['test' => 'is ok'], $result->__toArray());

        $result = $repo->putResult($data);
        $this->assertInstanceOf(PluginEmpty::class, $result);
        $this->assertEquals(['test' => 'is ok'], $result->__toArray());

        $result = $repo->postResult($data);
        $this->assertInstanceOf(PluginEmpty::class, $result);
        $this->assertEquals(['test' => 'is ok'], $result->__toArray());

        $result = $repo->getResult($data);
        $this->assertInstanceOf(PluginEmpty::class, $result);
        $this->assertEquals(['test' => 'is ok'], $result->__toArray());

        $repo[JiraRepository::FIELD__RESULT_CLASS_GET] = null;
        $this->expectExceptionMessage('Missed or unknown ' . JiraRepository::FIELD__RESULT_CLASS_GET . ' result class');
        $repo->getResult($data);
    }

    public function testDrop()
    {
        $repo = $this->getRepo();

        $this->expectExceptionMessage('Method is not allowed');
        $repo->drop();
    }

    /**
     * @return IJIraRepository
     */
    protected function getRepo(): IJIraRepository
    {
        return new class ([
            JiraRepository::FIELD__RESULT_CLASS_DELETE => PluginEmpty::class,
            JiraRepository::FIELD__RESULT_CLASS_PUT => PluginEmpty::class,
            JiraRepository::FIELD__RESULT_CLASS_POST => PluginEmpty::class,
            JiraRepository::FIELD__RESULT_CLASS_GET => PluginEmpty::class,
        ]) extends JiraRepository {
            public function create($item)
            {
                return $item;
            }

            public function update($item, $where = []): int
            {
                return 0;
            }

            public function delete($where, $item = null): int
            {
                return 0;
            }

            public function one($where, int $offset = 0, array $fields = [])
            {
                return null;
            }

            public function all($where, int $limit = 0, int $offset = 0, array $orderBy = [], array $fields = [])
            {
                return [];
            }

            public function group(array $byFields): IRepository
            {
                return $this;
            }
        };
    }
}
