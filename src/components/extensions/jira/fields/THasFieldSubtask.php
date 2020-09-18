<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldSubtask;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldSubtask
 *
 * @package extas\components\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldSubtask
{
    /**
     * @param IField|null $field
     * @return bool
     */
    public function getFieldSubtask(IField $field = null): bool
    {
        return (bool) $field->getParameterValue(IHasFieldSubtask::PARAM__FIELD_SUBTASK, false);
    }
}
