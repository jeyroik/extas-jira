<?php
namespace extas\components\jira;

use extas\components\Item;
use extas\interfaces\jira\IJql;

/**
 * Class Jql
 *
 * @package extas\components\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
class Jql extends Item implements IJql
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return '(' . implode(') and (', $this->getQuery()) . ')';
    }

    /**
     * @param string $fieldName
     * @param string $condition
     * @param string $value
     * @return $this
     */
    public function andCondition(string $fieldName, string $condition, string $value)
    {
        $query = $this->getQuery();
        $query[] = $fieldName . ' ' . $condition . ' ' . $value;
        $this->config[static::FIELD__QUERY] = $query;

        return $this;
    }

    /**
     * @return array
     */
    public function getQuery(): array
    {
        return $this->config[static::FIELD__QUERY] ?? [];
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
