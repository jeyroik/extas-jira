<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldSelf;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldSelf
 *
 * @package extas\components\extensions\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldSelf
{
    /**
     * @param IField|null $field
     * @return string
     */
    public function getFieldSelf(IField $field = null): string
    {
        return $field->getParameterValue(IHasFieldSelf::PARAM__FIELD_SELF, '');
    }
}
