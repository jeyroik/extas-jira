<?php
namespace extas\components\jira\issues\changelog;

use extas\components\Item;
use extas\components\jira\results\THasMaxResults;
use extas\components\jira\results\THasStartAt;
use extas\components\jira\results\THasTotal;
use extas\interfaces\jira\issues\changelog\IChangelog;
use extas\interfaces\jira\issues\changelog\IHistory;
use extas\interfaces\jira\issues\changelog\IHistoryItem;

/**
 * Class Changelog
 *
 * @package extas\components\jira\issues\changelog
 * @author jeyroik <jeyroik@gmail.com>
 */
class Changelog extends Item implements IChangelog
{
    use THasStartAt;
    use THasMaxResults;
    use THasTotal;

    /**
     * @return IHistory[]
     */
    public function getHistory(): array
    {
        $itemsData = $this->config[static::FIELD__HISTORY] ?? [];
        $history = [];

        foreach ($itemsData as $item) {
            $history[] = new History($item);
        }

        return $history;
    }

    /**
     * @param array $where
     * @return IHistory|null
     */
    public function one(array $where = []): ?IHistory
    {
        list($where, $whereItems) = $this->splitWhere($where);

        $history = $this->getHistory();
        foreach ($history as $item) {
            $prepared = $this->prepare('', $item->__toArray());
            if (
                $this->isValid($where, $prepared)
                && (empty($whereItems) || $this->findHistoryItem($whereItems, $item))
            ) {
                return $item;
            }
        }

        return null;
    }

    /**
     * @param array $where
     * @param IHistory|null $item
     * @return IHistoryItem|null
     */
    public function oneItem(array $where = []): ?IHistoryItem
    {
        $item = $this->one($where);

        if ($item) {
            $subItems = $item->getItems();
            return array_shift($subItems);
        }

        return null;
    }

    /**
     * @param array $where
     * @return IHistory[]
     */
    public function all(array $where = []): array
    {
        list($where, $whereItems) = $this->splitWhere($where);
        $history = $this->getHistory();
        $result = [];
        foreach ($history as $item) {
            $prepared = $this->prepare('', $item->__toArray());
            if (
                $this->isValid($where, $prepared)
                && (empty($whereItems) || $this->findHistoryItem($whereItems, $item))
            ) {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * @param array $where
     * @param IHistory|null $item
     * @return array
     */
    public function allItems(array $where): array
    {
        list($where, $whereItems) = $this->splitWhere($where);
        $history = $this->getHistory();
        $result = [];
        foreach ($history as $item) {
            $prepared = $this->prepare('', $item->__toArray());
            if ($this->isValid($where, $prepared)) {
                $result = $this->appendItems($result, $whereItems, $item);
            }
        }

        return $result;
    }

    /**
     * @param array $result
     * @param array $whereItems
     * @param IHistory $item
     * @return array
     */
    protected function appendItems(array $result, array $whereItems, IHistory $item): array
    {
        return empty($whereItems)
            ? array_merge($result, $item->getItems())
            : array_merge($result, $this->findHistoryItems($whereItems, $item));
    }

    /**
     * @param array $where
     * @param IHistory $item
     * @return IHistoryItem|null
     */
    protected function findHistoryItem(array $where, IHistory $item): ?IHistoryItem
    {
        $subItems = $item->getItems();
        foreach ($subItems as $subItem) {
            $prepared = $this->prepare('', $subItem->__toArray());
            if ($this->isValid($where, $prepared)) {
                return $subItem;
            }
        }

        return null;
    }

    /**
     * @param array $where
     * @param IHistory $item
     * @return array
     */
    protected function findHistoryItems(array $where, IHistory $item): array
    {
        $result = [];
        $subItems = $item->getItems();
        foreach ($subItems as $subItem) {
            $prepared = $this->prepare('', $subItem->__toArray());
            if ($this->isValid($where, $prepared)) {
                $result[] = $subItem;
            }
        }

        return $result;
    }

    /**
     * @param array $where
     * @return array
     */
    protected function splitWhere(array $where): array
    {
        $whereItems = [];
        if (isset($where[IHistory::FIELD__ITEMS])) {
            $whereItems = $where[IHistory::FIELD__ITEMS];
            unset($where[IHistory::FIELD__ITEMS]);
        }

        return [$where, $whereItems];
    }

    /**
     * @param array $where
     * @param array $prepared
     * @return bool
     */
    protected function isValid(array $where, array $prepared)
    {
        foreach ($where as $field => $value) {
            if (!isset($prepared[$field]) || ($prepared[$field] != $value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $name
     * @param $value
     * @return mixed
     */
    protected function prepare(string $name, $value)
    {
        $dottedName = $name ? $name . '.' : '';
        $result = [];

        if (is_array($value)) {
            foreach ($value as $subField => $subValue) {
                $current = $this->prepare($dottedName . $subField, $subValue);
                is_array($current)
                    ? $result = array_merge($result, $current)
                    :  $result[$dottedName . $subField] = $current;
            }
        } else {
            return $result = $value;
        }

        return $result;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
