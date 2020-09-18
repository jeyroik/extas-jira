<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldDescription;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldDescription
 *
 * @package extas\components\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldDescription
{
    /**
     * @param IField|null $field
     * @return string
     */
    public function getFieldDescription(IField $field = null): string
    {
        return $field->getParameterValue(IHasFieldDescription::PARAM__FIELD_DESCRIPTION, '');
    }
}
