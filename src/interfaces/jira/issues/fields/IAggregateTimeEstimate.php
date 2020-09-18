<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldValue;

/**
 * Interface IAggregateTimeEstimate
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IAggregateTimeEstimate extends IHasFieldValue
{
    public const NAME = 'aggregatetimeestimate';
}
