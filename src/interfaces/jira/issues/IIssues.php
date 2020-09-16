<?php
namespace extas\interfaces\jira\issues;

use extas\interfaces\IItem;
use extas\interfaces\jira\ISchemaItem;
use extas\interfaces\jira\results\IHasIssues;
use extas\interfaces\jira\results\IHasNames;
use extas\interfaces\jira\results\IHasSchema;

/**
 * Interface IIssues
 *
 * @package extas\interfaces\jira\issues
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IIssues extends IItem, IHasNames, IHasSchema, IHasIssues
{
    public const SUBJECT = 'extas.jira.issue.collection';

    /**
     * @return array
     */
    public function getFieldsNames(): array;

    /**
     * @return ISchemaItem[]
     */
    public function getFieldsSchema(): array;

    /**
     * @return int
     */
    public function count(): int;

    /**
     * @return IIssue|null
     */
    public function current();
}
