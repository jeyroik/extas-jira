<?php
namespace extas\components\jira\issues\fields;

use extas\interfaces\IHasValue;
use extas\interfaces\jira\issues\fields\IHasFields;

/**
 * Trait THasFields
 *
 * @property array $config
 *
 * @package extas\components\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFields
{
    /**
     * @return array
     */
    public function getFields(): array
    {
        $fieldsData = $this->config[IHasFields::FIELD__FIELDS] ?? [];
        $fields = [];

        foreach ($fieldsData as $name => $field) {
            $field = is_array($field) ? $field : [IHasValue::FIELD__VALUE => $field];
            $fields[$name] = new Field($field);
        }

        return $fields;
    }
}
