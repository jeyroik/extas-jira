<?php
namespace extas\components\jira\results;

use extas\interfaces\jira\results\IHasStartAt;

/**
 * Trait THasStartAt
 *
 * @property array $config
 *
 * @package extas\components\jira\results
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasStartAt
{
    /**
     * @return int
     */
    public function getStartAt(): int
    {
        return $this->config[IHasStartAt::FIELD__START_AT] ?? 0;
    }
}
