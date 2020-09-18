<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldValue;

/**
 * Interface IAggregateTimeOriginalEstimate
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IAggregateTimeOriginalEstimate extends IHasFieldValue
{
    public const NAME = 'aggregatetimeoriginalestimate';
}
