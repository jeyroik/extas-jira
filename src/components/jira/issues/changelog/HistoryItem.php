<?php
namespace extas\components\jira\issues\changelog;

use extas\components\Item;
use extas\interfaces\jira\issues\changelog\IHistoryItem;

/**
 * Class HistoryItem
 *
 * @package extas\components\jira\issues\changelog
 * @author jeyroik <jeyroik@gmail.com>
 */
class HistoryItem extends Item implements IHistoryItem
{
    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->config[static::FIELD__FIELD] ?? '';
    }

    /**
     * @return string
     */
    public function getFieldType(): string
    {
        return $this->config[static::FIELD__FIELD_TYPE] ?? '';
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->config[static::FIELD__FROM] ?? '';
    }

    /**
     * @return string
     */
    public function getFromString(): string
    {
        return $this->config[static::FIELD__FROM_STRING] ?? '';
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->config[static::FIELD__TO] ?? '';
    }

    /**
     * @return string
     */
    public function getToString(): string
    {
        return $this->config[static::FIELD__TO_STRING] ?? '';
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
