<?php
namespace extas\interfaces\jira\results;

/**
 * Interface IHasStartAt
 *
 * @package extas\interfaces\jira\results
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasStartAt
{
    public const FIELD__START_AT = 'startAt';

    /**
     * @return int
     */
    public function getStartAt(): int;
}
