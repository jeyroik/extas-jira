<?php
namespace extas\components\jira\results;

use extas\interfaces\jira\results\IHasMaxResults;

/**
 * Trait THasMaxResults
 *
 * @property array $config
 *
 * @package extas\components\jira\results
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasMaxResults
{
    /**
     * @return int
     */
    public function getMaxResults(): int
    {
        return $this->config[IHasMaxResults::FIELD__MAX_RESULTS] ?? 0;
    }
}
