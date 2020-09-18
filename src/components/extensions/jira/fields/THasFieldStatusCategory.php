<?php
namespace extas\components\extensions\jira\fields;

use extas\components\jira\issues\fields\StatusCategory;
use extas\interfaces\extensions\jira\fields\IHasFieldStatusCategory;
use extas\interfaces\jira\issues\fields\IField;
use extas\interfaces\jira\issues\fields\IStatusCategory;

/**
 * Trait THasFieldStatusCategory
 *
 * @package extas\components\extensions\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldStatusCategory
{
    /**
     * @param IField|null $field
     * @return IStatusCategory
     */
    public function getFieldStatusCategory(IField $field = null): IStatusCategory
    {
        return new StatusCategory(
            $field->getParameterValue(IHasFieldStatusCategory::PARAM__FIELD_STATUS_CATEGORY, 0)
        );
    }
}
