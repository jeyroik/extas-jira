<?php
namespace extas\components\jira\results;

use extas\interfaces\jira\results\IHasTotal;

/**
 * Trait THasTotal
 *
 * @property array $config
 *
 * @package extas\components\jira\results
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasTotal
{
    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->config[IHasTotal::FIELD__TOTAL] ?? 0;
    }
}
