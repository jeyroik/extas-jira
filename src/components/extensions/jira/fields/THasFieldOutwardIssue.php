<?php
namespace extas\components\extensions\jira\fields;

use extas\components\jira\issues\Issue;
use extas\interfaces\extensions\jira\fields\IHasFieldId;
use extas\interfaces\extensions\jira\fields\IHasFieldInwardIssue;
use extas\interfaces\extensions\jira\fields\IHasFieldOutwardIssue;
use extas\interfaces\jira\issues\fields\IField;
use extas\interfaces\jira\issues\IIssue;

/**
 * Trait THasFieldOutwardIssue
 *
 * @package extas\components\extensions\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldOutwardIssue
{
    /**
     * @param IField|null $field
     * @return IIssue
     */
    public function getFieldOutwardIssue(IField $field = null): IIssue
    {
        $issueData = $field->getParameterValue(IHasFieldOutwardIssue::PARAM__FIELD_OUTWARD_ISSUE, []);
        return new Issue($issueData);
    }
}
