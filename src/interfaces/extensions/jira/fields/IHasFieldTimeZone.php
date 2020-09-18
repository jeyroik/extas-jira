<?php

namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldTimeZone
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldTimeZone
{
    public const PARAM__FIELD_TIME_ZONE = 'timeZone';

    /**
     * @return string
     */
    public function getFieldTimeZone(): string;
}
