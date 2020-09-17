<?php
namespace extas\interfaces\jira;

/**
 * Interface IHasSchema
 *
 * @package extas\interfaces\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasSchema
{
    public const FIELD__SCHEMA = 'schema';

    /**
     * @return ISchemaItem
     */
    public function getSchema(): ISchemaItem;
}
