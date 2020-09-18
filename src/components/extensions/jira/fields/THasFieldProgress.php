<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldProgress;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldProgress
 *
 * @package extas\components\extensions\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldProgress
{
    /**
     * @param IField|null $field
     * @return int
     */
    public function getFieldProgress(IField $field = null): int
    {
        return $field->getParameterValue(IHasFieldProgress::PARAM__FIELD_PROGRESS, 0);
    }
}
