<?php
namespace tests\jira;

use Dotenv\Dotenv;
use extas\components\jira\Uri;
use PHPUnit\Framework\TestCase;

/**
 * Class UriTest
 *
 * @package tests\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
class UriTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
    }

    public function testBasicMethods()
    {
        $uri = new Uri();
        $uri->addParams([
            'test' => 'is ok'
        ]);
        $uri->setPath('https://test/');

        $this->assertEquals(
            'https://test/?test=is ok',
            $uri->__toString(),
            'Incorrect uri: ' . $uri
        );
    }
}
