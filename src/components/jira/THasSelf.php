<?php
namespace extas\components\jira;

use extas\interfaces\jira\IHasSelf;

/**
 * Trait THasSelf
 *
 * @property array $config
 *
 * @package extas\components\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasSelf
{
    /**
     * @return string
     */
    public function getSelf(): string
    {
        return $this->config[IHasSelf::FIELD__SELF] ?? '';
    }
}
