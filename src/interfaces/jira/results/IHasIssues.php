<?php
namespace extas\interfaces\jira\results;

use extas\interfaces\jira\issues\IIssue;

/**
 * Interface IHasIssues
 *
 * @package extas\interfaces\jira\results
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasIssues
{
    public const FIELD__ISSUES = 'issues';

    /**
     * @return IIssue[]
     */
    public function getIssues(): array;
}
