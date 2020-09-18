<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldValue;

/**
 * Interface IAggregateTimeSpent
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IAggregateTimeSpent extends IHasFieldValue
{
    public const NAME = 'aggregatetimespent';
}
