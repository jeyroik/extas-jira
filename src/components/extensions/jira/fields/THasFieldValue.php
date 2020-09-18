<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldValue;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldValue
 *
 * @package extas\components\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldValue
{
    /**
     * @param IField|null $field
     * @return mixed
     */
    public function getFieldValue(IField $field = null)
    {
        return $field->getParameterValue(IHasFieldValue::PARAM__FIELD_VALUE, null);
    }
}
