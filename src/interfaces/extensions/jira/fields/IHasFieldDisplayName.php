<?php

namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldDisplayName
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldDisplayName
{
    public const PARAM__FIELD_DISPLAY_NAME = 'displayName';

    /**
     * @return string
     */
    public function getFieldDisplayName(): string;
}
