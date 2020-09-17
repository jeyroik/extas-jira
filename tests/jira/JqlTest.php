<?php
namespace tests\jira;

use Dotenv\Dotenv;
use extas\components\jira\Jql;
use PHPUnit\Framework\TestCase;

/**
 * Class JqlTest
 *
 * @package tests\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
class JqlTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
    }

    public function testBasicMethods()
    {
        $jql = new Jql();
        $jql->orderBy('some', 'asc');
        $jql->andConditions([
            ['test', 'is', 'ok']
        ]);
        $this->assertEquals(
            '(test is ok) ORDER BY some asc',
            $jql->__toString(),
            'Incorrect add conditions: ' . $jql->__toString()
        );
    }
}
