<?php
namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldName
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldName
{
    public const PARAM__FIELD_NAME = 'name';

    /**
     * @return string
     */
    public function getFieldName(): string;
}
