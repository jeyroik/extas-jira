<?php
namespace extas\components\jira\issues\fields;

use extas\interfaces\IHasValue;
use extas\interfaces\jira\issues\fields\IField;
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
            $field = is_array($field) && !is_numeric(array_key_first($field))
                ? $field
                : [IHasValue::FIELD__VALUE => $field];
            $fields[$name] = new Field($field);
        }

        return $fields;
    }

    /**
     * @param string $name
     * @return IField
     */
    public function getField(string $name): IField
    {
        $fieldsData = $this->config[IHasFields::FIELD__FIELDS] ?? [];
        $field = $fieldsData[$name] ?? [];
        $field = is_array($field) && !is_numeric(array_key_first($field))
            ? $field
            : [IHasValue::FIELD__VALUE => $field];

        return new Field($field);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasField(string $name): bool
    {
        $fieldsData = $this->config[IHasFields::FIELD__FIELDS] ?? [];

        return isset($fieldsData[$name]);
    }
}
