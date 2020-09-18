<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldDescription;
use extas\interfaces\extensions\jira\fields\IHasFieldIconUrl;
use extas\interfaces\extensions\jira\fields\IHasFieldId;
use extas\interfaces\extensions\jira\fields\IHasFieldName;
use extas\interfaces\extensions\jira\fields\IHasFieldSelf;
use extas\interfaces\extensions\jira\fields\IHasFieldStatusCategory;

/**
 * Interface IStatus
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IStatus extends
    IHasFieldSelf,
    IHasFieldDescription,
    IHasFieldIconUrl,
    IHasFieldName,
    IHasFieldId,
    IHasFieldStatusCategory
{
    public const NAME = 'status';
}
