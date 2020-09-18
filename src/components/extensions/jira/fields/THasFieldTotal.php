<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldTotal;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldTotal
 *
 * @package extas\components\extensions\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldTotal
{
    /**
     * @param IField|null $field
     * @return int
     */
    public function getFieldTotal(IField $field = null): int
    {
        return $field->getParameterValue(IHasFieldTotal::PARAM__FIELD_TOTAL, 0);
    }
}
