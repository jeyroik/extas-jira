<?php
namespace extas\interfaces\extensions\jira\fields;

use extas\interfaces\jira\issues\fields\IIssueLink;

/**
 * Interface IHasFieldIssueLinks
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldIssueLinks
{
    /**
     * @return IIssueLink[]
     */
    public function getFieldLinks(): array;
}
