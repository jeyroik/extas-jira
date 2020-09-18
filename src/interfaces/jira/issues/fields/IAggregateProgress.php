<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldPercent;
use extas\interfaces\extensions\jira\fields\IHasFieldProgress;
use extas\interfaces\extensions\jira\fields\IHasFieldTotal;

/**
 * Interface IAggregateProgress
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IAggregateProgress extends IHasFieldProgress, IHasFieldPercent, IHasFieldTotal
{
    public const NAME = 'aggregateprogress';
}
