<?php
namespace extas\components\jira;

use extas\interfaces\jira\IHasKey;

/**
 * Trait THasKey
 *
 * @property array $config
 *
 * @package extas\components\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasKey
{
    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->config[IHasKey::FIELD__KEY] ?? '';
    }
}
