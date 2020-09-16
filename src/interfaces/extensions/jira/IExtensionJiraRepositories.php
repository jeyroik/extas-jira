<?php
namespace extas\interfaces\extensions\jira;

use extas\interfaces\jira\IJIraRepository;

/**
 * Interface IExtensionJiraRepositories
 *
 * @package extas\interfaces\extensions\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IExtensionJiraRepositories
{
    /**
     * @param string $instanceName
     * @param string $password
     * @return IJIraRepository
     */
    public function jiraIssues(string $instanceName, string $password): IJIraRepository;
}
