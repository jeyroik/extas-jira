<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldId;
use extas\interfaces\extensions\jira\fields\IHasFieldInwardIssue;
use extas\interfaces\extensions\jira\fields\IHasFieldLinkType;
use extas\interfaces\extensions\jira\fields\IHasFieldOutwardIssue;
use extas\interfaces\extensions\jira\fields\IHasFieldSelf;

/**
 * Interface IIssueLink
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IIssueLink extends IHasFieldId, IHasFieldSelf, IHasFieldLinkType, IHasFieldInwardIssue, IHasFieldOutwardIssue
{
}
