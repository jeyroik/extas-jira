<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldActive;
use extas\interfaces\extensions\jira\fields\IHasFieldAvatarUrls;
use extas\interfaces\extensions\jira\fields\IHasFieldDisplayName;
use extas\interfaces\extensions\jira\fields\IHasFieldEmailAddress;
use extas\interfaces\extensions\jira\fields\IHasFieldKey;
use extas\interfaces\extensions\jira\fields\IHasFieldName;
use extas\interfaces\extensions\jira\fields\IHasFieldSelf;
use extas\interfaces\extensions\jira\fields\IHasFieldTimeZone;

/**
 * Interface IUser
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IUser extends
    IHasFieldSelf,
    IHasFieldName,
    IHasFieldKey,
    IHasFieldEmailAddress,
    IHasFieldAvatarUrls,
    IHasFieldDisplayName,
    IHasFieldActive,
    IHasFieldTimeZone
{

}
