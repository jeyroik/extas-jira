<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldPercent;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldPercent
 *
 * @package extas\components\extensions\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldPercent
{
    /**
     * @param IField|null $field
     * @return int
     */
    public function getFieldPercent(IField $field = null): int
    {
        return $field->getParameterValue(IHasFieldPercent::PARAM__FIELD_PERCENT, 0);
    }
}
