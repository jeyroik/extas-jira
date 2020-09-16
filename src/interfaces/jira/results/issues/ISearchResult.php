<?php
namespace extas\interfaces\jira\results\issues;

use extas\interfaces\IItem;
use extas\interfaces\jira\IHasExpand;
use extas\interfaces\jira\results\IHasIssues;
use extas\interfaces\jira\results\IHasMaxResults;
use extas\interfaces\jira\results\IHasNames;
use extas\interfaces\jira\results\IHasSchema;
use extas\interfaces\jira\results\IHasStartAt;
use extas\interfaces\jira\results\IHasTotal;

/**
 * Interface ISearchResult
 *
 * @package extas\interfaces\jira\results
 * @author jeyroik <jeyroik@gmail.com>
 */
interface ISearchResult extends
    IItem,
    IHasExpand,
    IHasTotal,
    IHasIssues,
    IHasMaxResults,
    IHasStartAt,
    IHasNames,
    IHasSchema
{
    public const SUBJECT = 'extas.jira.result.search';
}
