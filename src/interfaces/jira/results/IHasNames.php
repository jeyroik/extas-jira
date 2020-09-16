<?php
namespace extas\interfaces\jira\results;

/**
 * Interface IHasNames
 *
 * @package extas\interfaces\jira\results
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasNames
{
    public const FIELD__NAMES = 'names';

    /**
     * @return array
     */
    public function getNames(): array;

    /**
     * @param string $fieldName
     * @return string
     */
    public function getName(string $fieldName): string;

    /**
     * @param string $fieldName
     * @return bool
     */
    public function hasName(string $fieldName): bool;
}
