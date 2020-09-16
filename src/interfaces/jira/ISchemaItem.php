<?php
namespace extas\interfaces\jira;

use extas\interfaces\IHasType;
use extas\interfaces\IItem;

/**
 * Interface ISchemaItem
 *
 * @package extas\interfaces\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
interface ISchemaItem extends IItem, IHasType
{
    public const SUBJECT = 'extas.jira.schema.item';

    public const FIELD__ITEMS = 'items';
    public const FIELD__SYSTEM = 'system';
    public const FIELD__CUSTOM = 'custom';
    public const FIELD__CUSTOM_ID = 'customId';

    public const TYPE__STRING = 'string';
    public const TYPE__NUMBER = 'number';
    public const TYPE__OPTION = 'option';
    public const TYPE__ARRAY = 'array';
    public const TYPE__RESOLUTION = 'resolution';
    public const TYPE__DATE = 'date';
    public const TYPE__DATETIME = 'datetime';
    public const TYPE__USER = 'user';
    public const TYPE__PRIORITY = 'priority';
    public const TYPE__STATUS = 'status';
    public const TYPE__ANY = 'any';
    public const TYPE__PROGRESS = 'progress';
    public const TYPE__VOTES = 'votes';
    public const TYPE__ISSUE_TYPE = 'issuetype';
    public const TYPE__PROJECT = 'project';
    public const TYPE__WATCHES = 'watches';

    /**
     * @param string $type
     * @return bool
     */
    public function isTypeOf(string $type): bool;

    /**
     * @return string
     */
    public function getItems(): string;

    /**
     * @return string
     */
    public function getSystem(): string;

    /**
     * @return string
     */
    public function getCustom(): string;

    /**
     * @return int
     */
    public function getCustomId(): int;
}
