<?php
namespace extas\interfaces\jira\issues\fields;

/**
 * Interface IHasFields
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFields
{
    public const FIELD__FIELDS = 'fields';

    /**
     * @return IField[]
     */
    public function getFields(): array;
}
