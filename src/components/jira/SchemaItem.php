<?php
namespace extas\components\jira;

use extas\components\Item;
use extas\components\THasType;
use extas\interfaces\jira\ISchemaItem;

/**
 * Class SchemaItem
 *
 * @package extas\components\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
class SchemaItem extends Item implements ISchemaItem
{
    use THasType;

    /**
     * @return string
     */
    public function getCustom(): string
    {
        return $this->config[static::FIELD__CUSTOM] ?? '';
    }

    /**
     * @return int
     */
    public function getCustomId(): int
    {
        return $this->config[static::FIELD__CUSTOM_ID] ?? 0;
    }

    /**
     * @return string
     */
    public function getSystem(): string
    {
        return $this->config[static::FIELD__SYSTEM] ?? '';
    }

    /**
     * @return string
     */
    public function getItems(): string
    {
        return $this->config[static::FIELD__ITEMS] ?? '';
    }

    /**
     * @param string $type
     * @return bool
     */
    public function isTypeOf(string $type): bool
    {
        return $this->getType() === $type;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
