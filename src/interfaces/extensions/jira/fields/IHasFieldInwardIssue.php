<?php
namespace extas\interfaces\extensions\jira\fields;

use extas\interfaces\jira\issues\IIssue;

/**
 * Interface IHasFieldInwardIssue
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldInwardIssue
{
    public const PARAM__FIELD_INWARD_ISSUE = 'inwardIssue';

    /**
     * @return IIssue
     */
    public function getFieldInwardIssue(): IIssue;
}
