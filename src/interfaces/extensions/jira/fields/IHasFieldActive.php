<?php

namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldActive
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldActive
{
    public const PARAM__FIELD_ACTIVE = 'active';

    /**
     * @return bool
     */
    public function getFieldActive(): bool;
}
