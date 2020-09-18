<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldActive;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldActive
 *
 * @package extas\components\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldActive
{
    /**
     * @param IField|null $field
     * @return bool
     */
    public function getFieldActive(IField $field = null): bool
    {
        return (bool) $field->getParameterValue(IHasFieldActive::PARAM__FIELD_ACTIVE, false);
    }
}
