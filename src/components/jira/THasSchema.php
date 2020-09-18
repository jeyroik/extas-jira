<?php
namespace extas\components\jira;

use extas\interfaces\jira\IHasSchema;
use extas\interfaces\jira\ISchemaItem;

/**
 * Trait THasSchema
 *
 * @property array $config
 *
 * @package extas\components\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasSchema
{
    /**
     * @return ISchemaItem
     */
    public function getSchema(): ISchemaItem
    {
        $schemaData = $this->config[IHasSchema::FIELD__SCHEMA] ?? [];

        return new SchemaItem($schemaData);
    }
}
