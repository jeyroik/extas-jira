<?php
namespace extas\interfaces\extensions\jira\fields;

use extas\interfaces\jira\issues\IIssue;

/**
 * Interface IHasFieldOutwardIssue
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldOutwardIssue
{
    public const PARAM__FIELD_OUTWARD_ISSUE = 'outwardIssue';

    /**
     * @return IIssue
     */
    public function getFieldOutwardIssue(): IIssue;
}
