<?php
namespace extas\components\extensions\jira;

use extas\components\extensions\Extension;
use extas\components\jira\issues\IssueRepository;
use extas\interfaces\extensions\jira\IExtensionJiraRepositories;
use extas\interfaces\jira\IJIraRepository;

/**
 * Class ExtensionJiraRepositories
 *
 * @package extas\components\extensions\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
class ExtensionJiraRepositories extends Extension implements IExtensionJiraRepositories
{
    /**
     * @param string $instanceName
     * @param string $password
     * @return IJIraRepository
     */
    public function jiraIssues(string $instanceName, string $password): IJIraRepository
    {
        return new IssueRepository([
            IssueRepository::FIELD__SECRET_PASSWORD => $password,
            IssueRepository::OPTION__REPOSITORY_NAME => $instanceName
        ]);
    }
}
