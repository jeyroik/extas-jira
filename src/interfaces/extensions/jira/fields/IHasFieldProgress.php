<?php

namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldProgress
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldProgress
{
    public const PARAM__FIELD_PROGRESS = 'progress';

    /**
     * @return int
     */
    public function getFieldProgress(): int;
}
