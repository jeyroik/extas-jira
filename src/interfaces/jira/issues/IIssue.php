<?php
namespace extas\interfaces\jira\issues;

use extas\interfaces\IHasId;
use extas\interfaces\IItem;
use extas\interfaces\jira\IHasExpand;
use extas\interfaces\jira\IHasKey;
use extas\interfaces\jira\IHasSelf;

/**
 * Interface IIssue
 *
 * @package extas\interfaces\jira\issues
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IIssue extends IItem, IHasId, IHasExpand, IHasSelf, IHasKey
{
    public const SUBJECT = 'extas.jira.issue';
}
