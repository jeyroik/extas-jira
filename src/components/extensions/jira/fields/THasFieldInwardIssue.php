<?php
namespace extas\components\extensions\jira\fields;

use extas\components\jira\issues\Issue;
use extas\interfaces\extensions\jira\fields\IHasFieldId;
use extas\interfaces\extensions\jira\fields\IHasFieldInwardIssue;
use extas\interfaces\jira\issues\fields\IField;
use extas\interfaces\jira\issues\IIssue;

/**
 * Trait THasFieldInwardIssue
 *
 * @package extas\components\extensions\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldInwardIssue
{
    /**
     * @param IField|null $field
     * @return IIssue
     */
    public function getFieldInwardIssue(IField $field = null): IIssue
    {
        $issueData = $field->getParameterValue(IHasFieldInwardIssue::PARAM__FIELD_INWARD_ISSUE, []);
        return new Issue($issueData);
    }
}
