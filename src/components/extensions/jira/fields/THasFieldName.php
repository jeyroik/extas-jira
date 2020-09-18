<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\jira\issues\fields\IField;
use extas\interfaces\extensions\jira\fields\IHasFieldName;

/**
 * Trait THasFieldName
 *
 * @package extas\components\extensions\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldName
{
    /**
     * @param IField|null $field
     * @return string
     */
    public function getFieldName(IField $field = null): string
    {
        return $field->getParameterValue(IHasFieldName::PARAM__FIELD_NAME, 0);
    }
}
