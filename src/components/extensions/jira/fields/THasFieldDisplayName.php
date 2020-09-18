<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldDisplayName;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldDisplayName
 *
 * @package extas\components\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldDisplayName
{
    /**
     * @param IField|null $field
     * @return string
     */
    public function getFieldDisplayName(IField $field = null): string
    {
        return $field->getParameterValue(IHasFieldDisplayName::PARAM__FIELD_DISPLAY_NAME, '');
    }
}
