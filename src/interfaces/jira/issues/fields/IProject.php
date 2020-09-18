<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldId;
use extas\interfaces\extensions\jira\fields\IHasFieldSelf;
use extas\interfaces\extensions\jira\fields\IHasFieldName;
use extas\interfaces\extensions\jira\fields\IHasFieldAvatarUrls;
use extas\interfaces\extensions\jira\fields\IHasFieldKey;
use extas\interfaces\extensions\jira\fields\IHasFieldProjectTypeKey;

/**
 * Interface IProject
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IProject extends
    IHasFieldId,
    IHasFieldKey,
    IHasFieldSelf,
    IHasFieldName,
    IHasFieldProjectTypeKey,
    IHasFieldAvatarUrls
{
    public const NAME = 'project';
}
