<?php
namespace extas\interfaces\jira\results;

/**
 * Interface IHasTotal
 *
 * @package extas\interfaces\jira\results
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasTotal
{
    public const FIELD__TOTAL = 'total';

    /**
     * @return int
     */
    public function getTotal(): int;
}
