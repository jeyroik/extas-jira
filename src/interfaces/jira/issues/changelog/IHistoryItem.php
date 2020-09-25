<?php
namespace extas\interfaces\jira\issues\changelog;

use extas\interfaces\IItem;

/**
 * Interface IHistoryItem
 *
 * @package extas\interfaces\jira\issues\changelog
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHistoryItem extends IItem
{
    public const SUBJECT = 'extas.jira.issue.changelog.history.item';

    public const FIELD__FIELD = 'field';
    public const FIELD__FIELD_TYPE = 'fieldtype';
    public const FIELD__FROM = 'from';
    public const FIELD__FROM_STRING = 'fromString';
    public const FIELD__TO = 'to';
    public const FIELD__TO_STRING = 'toString';

    /**
     * @return string
     */
    public function getField(): string;

    /**
     * @return string
     */
    public function getFieldType(): string;

    /**
     * @return string
     */
    public function getFrom(): string;

    /**
     * @return string
     */
    public function getFromString(): string;

    /**
     * @return string
     */
    public function getTo(): string;

    /**
     * @return string
     */
    public function getToString(): string;
}
