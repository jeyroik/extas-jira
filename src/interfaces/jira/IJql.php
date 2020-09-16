<?php
namespace extas\interfaces\jira;

use extas\interfaces\IItem;

/**
 * Interface IJql
 *
 * @package extas\interfaces\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IJql extends IItem
{
    public const SUBJECT = 'extas.jira.jql';

    public const FIELD__QUERY = 'query';

    /**
     * @return array
     */
    public function getQuery(): array;

    /**
     * @param string $fieldName
     * @param string $condition
     * @param string $value
     * @return $this
     */
    public function andCondition(string $fieldName, string $condition, string $value);
}
