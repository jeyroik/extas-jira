<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldValue;

/**
 * Interface ITimeOriginalEstimate
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface ITimeOriginalEstimate extends IHasFieldValue
{
    public const NAME = 'timeoriginalestimate';
}
