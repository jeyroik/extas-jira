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
    protected string $orderBy = '';

    /**
     * @return string
     */
    public function __toString(): string
    {
        return '(' . implode(') and (', $this->getQuery()) . ')' . $this->orderBy;
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
     * @param string $fieldName
     * @param string $asc
     * @return $this|Jql
     */
    public function orderBy(string $fieldName, string $asc)
    {
        $this->orderBy = ' ORDER BY ' . $fieldName . ' ' . $asc;

        return $this;
    }

    /**
     * @param array $conditions [ ['field1', '=', 'value1'], ['field2', '>' , 'value2'], ... ]
     * @return $this|Jql
     */
    public function andConditions(array $conditions)
    {
        foreach ($conditions as $condition) {
            $this->andCondition(...$condition);
        }

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
