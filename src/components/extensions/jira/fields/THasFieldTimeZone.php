<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldTimeZone;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldTimeZone
 *
 * @package extas\components\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldTimeZone
{
    /**
     * @param IField|null $field
     * @return string
     */
    public function getFieldTimeZone(IField $field = null): string
    {
        return $field->getParameterValue(IHasFieldTimeZone::PARAM__FIELD_TIME_ZONE, '');
    }
}
