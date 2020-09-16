<?php
namespace extas\components\jira\results;

use extas\components\jira\issues\Issue;
use extas\interfaces\jira\issues\IIssue;
use extas\interfaces\jira\results\IHasIssues;

/**
 * Trait THasIssues
 *
 * @property array $config
 *
 * @package extas\components\jira\results
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasIssues
{
    /**
     * @return IIssue[]
     */
    public function getIssues(): array
    {
        $issuesData = $this->config[IHasIssues::FIELD__ISSUES] ?? [];
        $issues = [];

        foreach ($issuesData as $issue) {
            $issues[] = new Issue($issue);
        }

        return $issues;
    }
}
