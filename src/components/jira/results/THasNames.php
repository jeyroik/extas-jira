<?php
namespace extas\components\jira\results;

use extas\interfaces\jira\results\IHasNames;

/**
 * Trait THasNames
 *
 * @property array $config
 *
 * @package extas\components\jira\results
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasNames
{
    /**
     * @return array
     */
    public function getNames(): array
    {
        return $this->config[IHasNames::FIELD__NAMES] ?? [];
    }

    /**
     * @param string $fieldName
     * @return string
     */
    public function getName(string $fieldName): string
    {
        return $this->getNames()[$fieldName] ?? '';
    }

    /**
     * @param string $fieldName
     * @return bool
     */
    public function hasName(string $fieldName): bool
    {
        return isset($this->getNames()[$fieldName]);
    }
}
