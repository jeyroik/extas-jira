<?php
namespace extas\interfaces\jira\issues\changelog;

use extas\interfaces\IItem;
use extas\interfaces\jira\results\IHasMaxResults;
use extas\interfaces\jira\results\IHasStartAt;
use extas\interfaces\jira\results\IHasTotal;

/**
 * Interface IChangelog
 *
 * @package extas\interfaces\jira\issues\changelog
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IChangelog extends IItem, IHasTotal, IHasMaxResults, IHasStartAt
{
    public const SUBJECT = 'extas.jira.issue.changelog';

    public const FIELD__HISTORY = 'histories';

    /**
     * @return IHistory[]
     */
    public function getHistory(): array;

    /**
     * @param array $where [author => jeyroik, ..., items => [field => status, from => Backlog, ...]]
     * @return IHistory|null
     */
    public function one(array $where = []): ?IHistory;

    /**
     * @param array $where [author => jeyroik, ..., items => [field => status, from => Backlog, ...]]
     * @return IHistoryItem|null
     */
    public function oneItem(array $where = []): ?IHistoryItem;

    /**
     * @param array $where [author => jeyroik, ..., items => [field => status, from => Backlog, ...]]
     * @return IHistory[]
     */
    public function all(array $where = []): array;

    /**
     * @param array $where [author => jeyroik, ..., items => [field => status, from => Backlog, ...]]
     * @return IHistoryItem[]
     */
    public function allItems(array $where): array;
}
