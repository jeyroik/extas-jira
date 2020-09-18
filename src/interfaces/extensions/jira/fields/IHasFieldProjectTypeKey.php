<?php
namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldProjectTypeKey
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldProjectTypeKey
{
    public const PARAM__FIELD_PROJECT_TYPE_KEY = 'projectTypeKey';

    /**
     * @return string
     */
    public function getFieldProjectTypeKey(): string;
}
