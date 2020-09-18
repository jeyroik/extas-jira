<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldKey;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldKey
 *
 * @package extas\components\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldKey
{
    /**
     * @param IField|null $field
     * @return string
     */
    public function getFieldKey(IField $field = null): string
    {
        return $field->getParameterValue(IHasFieldKey::PARAM__FIELD_KEY, '');
    }
}
