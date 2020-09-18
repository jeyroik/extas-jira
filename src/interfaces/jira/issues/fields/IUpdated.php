<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldValue;

/**
 * Interface IUpdated
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IUpdated extends IHasFieldValue
{
    public const NAME = 'updated';
}
