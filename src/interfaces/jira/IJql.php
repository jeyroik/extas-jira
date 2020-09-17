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

    public const ORDER__ASC = 'ASC';
    public const ORDER__DESC = 'DESC';

    /**
     * @return array
     */
    public function getQuery(): array;

    /**
     * @param string $fieldName
     * @param string $asc
     * @return $this
     */
    public function orderBy(string $fieldName, string $asc);

    /**
     * @param string $fieldName
     * @param string $condition
     * @param string $value
     * @return $this
     */
    public function andCondition(string $fieldName, string $condition, string $value);

    /**
     * @param array $conditions
     * @return $this
     */
    public function andConditions(array $conditions);
}
