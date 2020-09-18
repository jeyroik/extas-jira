<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldId;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldId
 *
 * @package extas\components\extensions\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldId
{
    /**
     * @param IField|null $field
     * @return int
     */
    public function getFieldId(IField $field = null): int
    {
        return $field->getParameterValue(IHasFieldId::PARAM__FIELD_ID, 0);
    }
}
