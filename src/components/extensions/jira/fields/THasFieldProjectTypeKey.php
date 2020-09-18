<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldProjectTypeKey;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldProjectTypeKey
 *
 * @package extas\components\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldProjectTypeKey
{
    /**
     * @param IField $field
     * @return string
     */
    public function getFieldProjectTypeKey(IField $field = null): string
    {
        return $field->getParameterValue(IHasFieldProjectTypeKey::PARAM__FIELD_PROJECT_TYPE_KEY, '');
    }
}
