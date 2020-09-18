<?php
namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldKey
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldKey
{
    public const PARAM__FIELD_KEY = 'key';

    /**
     * @return string
     */
    public function getFieldKey(): string;
}
