<?php
namespace extas\interfaces\jira\results;

/**
 * Interface IHasMaxResults
 *
 * @package extas\interfaces\jira\results
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasMaxResults
{
    public const FIELD__MAX_RESULTS = 'maxResults';

    /**
     * @return int
     */
    public function getMaxResults(): int;
}
