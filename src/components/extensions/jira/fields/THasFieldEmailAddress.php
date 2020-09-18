<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldEmailAddress;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldEmailAddress
 *
 * @package extas\components\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldEmailAddress
{
    /**
     * @param IField|null $field
     * @return string
     */
    public function getFieldEmailAddress(IField $field = null): string
    {
        return $field->getParameterValue(IHasFieldEmailAddress::PARAM__FIELD_EMAIL_ADDRESS, '');
    }
}
