<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldPercent;
use extas\interfaces\extensions\jira\fields\IHasFieldProgress;
use extas\interfaces\extensions\jira\fields\IHasFieldTotal;

/**
 * Interface IProgress
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IProgress extends IHasFieldProgress, IHasFieldPercent, IHasFieldTotal
{
    public const NAME = 'progress';
}
