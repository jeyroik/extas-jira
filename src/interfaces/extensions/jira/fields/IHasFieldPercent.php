<?php

namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldPercent
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldPercent
{
    public const PARAM__FIELD_PERCENT = 'percent';

    /**
     * @return int
     */
    public function getFieldPercent(): int;
}
