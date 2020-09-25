<?php
namespace extas\interfaces\jira\issues;

use extas\interfaces\IHasId;
use extas\interfaces\IItem;
use extas\interfaces\jira\IHasExpand;
use extas\interfaces\jira\IHasKey;
use extas\interfaces\jira\IHasSelf;
use extas\interfaces\jira\issues\changelog\IChangelog;
use extas\interfaces\jira\issues\fields\IHasFields;

/**
 * Interface IIssue
 *
 * @package extas\interfaces\jira\issues
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IIssue extends IItem, IHasId, IHasExpand, IHasSelf, IHasKey, IHasFields
{
    public const SUBJECT = 'extas.jira.issue';

    public const FIELD__CHANGELOG = 'changelog';

    /**
     * @return IChangelog|null
     */
    public function getChangelog(): ?IChangelog;
}
