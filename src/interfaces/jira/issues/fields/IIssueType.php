<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldAvatarId;
use extas\interfaces\extensions\jira\fields\IHasFieldDescription;
use extas\interfaces\extensions\jira\fields\IHasFieldIconUrl;
use extas\interfaces\extensions\jira\fields\IHasFieldId;
use extas\interfaces\extensions\jira\fields\IHasFieldName;
use extas\interfaces\extensions\jira\fields\IHasFieldSelf;
use extas\interfaces\extensions\jira\fields\IHasFieldSubtask;

/**
 * Interface IIssueType
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IIssueType extends
    IHasFieldId,
    IHasFieldName,
    IHasFieldSelf,
    IHasFieldDescription,
    IHasFieldIconUrl,
    IHasFieldSubtask,
    IHasFieldAvatarId
{
    public const NAME = 'issuetype';
}
