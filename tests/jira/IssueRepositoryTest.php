<?php
namespace tests\jira;

use Dotenv\Dotenv;
use extas\components\jira\issues\IssueRepository;
use PHPUnit\Framework\TestCase;

/**
 * Class IssueRepositoryTest
 *
 * @package tests\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
class IssueRepositoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
    }

    public function testCreate()
    {
        $repo = new IssueRepository();

        $this->expectExceptionMessage('Method is not implemented yet');
        $repo->create([]);
    }

    public function testUpdate()
    {
        $repo = new IssueRepository();

        $this->expectExceptionMessage('Method is not implemented yet');
        $repo->update([]);
    }

    public function testDelete()
    {
        $repo = new IssueRepository();

        $this->expectExceptionMessage('Method is not implemented yet');
        $repo->delete([]);
    }

    public function testGroup()
    {
        $repo = new IssueRepository();

        $this->expectExceptionMessage('Method is not implemented yet');
        $repo->group([]);
    }
}
