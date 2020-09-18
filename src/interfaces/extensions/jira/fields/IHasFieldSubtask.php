<?php

namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldSubtask
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldSubtask
{
    public const PARAM__FIELD_SUBTASK = 'subtask';

    /**
     * @return bool
     */
    public function getFieldSubtask(): bool;
}
