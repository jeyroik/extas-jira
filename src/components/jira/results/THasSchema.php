<?php
namespace extas\components\jira\results;

use extas\components\jira\SchemaItem;
use extas\interfaces\jira\ISchemaItem;
use extas\interfaces\jira\results\IHasSchema;

/**
 * Trait THasSchema
 *
 * @property array $config
 *
 * @package extas\components\jira\results
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasSchema
{
    /**
     * @return ISchemaItem[]
     */
    public function getSchema(): array
    {
        $itemsData = $this->config[IHasSchema::FIELD__NAME] ?? [];
        $items = [];

        foreach ($itemsData as $name => $item) {
            $items[$name] = new SchemaItem($item);
        }

        return $items;
    }
}
