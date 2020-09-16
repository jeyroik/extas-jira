<?php
namespace extas\interfaces\jira\results;

use extas\interfaces\jira\ISchemaItem;

/**
 * Interface IHasSchema
 *
 * @package extas\interfaces\jira\results
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasSchema
{
    public const FIELD__SCHEMA = 'schema';

    /**
     * @return ISchemaItem[]
     */
    public function getSchema(): array;
}
