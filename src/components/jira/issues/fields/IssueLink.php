<?php
namespace extas\components\jira\issues\fields;

use extas\interfaces\jira\issues\fields\IField;
use extas\interfaces\jira\issues\fields\IIssueLink;
use extas\interfaces\jira\issues\fields\ILinkType;

/**
 * Class IssueLink
 *
 * @package extas\components\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
class IssueLink extends Field
{
    /**
     * IssueLink constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct([]);
        $this->addParametersByValues($config);
    }
}
