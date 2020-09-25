<?php
namespace extas\components\jira\issues\changelog;

use extas\components\jira\issues\fields\Field;
use extas\components\Item;
use extas\components\THasId;
use extas\interfaces\extensions\jira\fields\IHasFieldValue;
use extas\interfaces\jira\issues\changelog\IHistory;
use extas\interfaces\jira\issues\fields\ICreated;
use extas\interfaces\jira\issues\fields\IField;
use extas\interfaces\jira\issues\fields\IUser;

/**
 * Class History
 *
 * @package extas\components\jira\issues\changelog
 * @author jeyroik <jeyroik@gmail.com>
 */
class History extends Item implements IHistory
{
    use THasId;

    /**
     * @return IField|IUser
     */
    public function getAuthor(): IField
    {
        $author = $this->config[static::FIELD__AUTHOR] ?? [];

        $field = new Field();
        $field->addParametersByValues($author);

        return $field;
    }

    /**
     * @return IField|ICreated
     */
    public function getCreated(): IField
    {
        $created = $this->config[static::FIELD__CREATED] ?? [];

        $field = new Field();
        $field->addParameterByValue(IHasFieldValue::PARAM__FIELD_VALUE, $created);

        return $field;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        $itemsData = $this->config[static::FIELD__ITEMS] ?? [];
        $items = [];

        foreach ($itemsData as $item) {
            $items[] = new HistoryItem($item);
        }

        return $items;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
