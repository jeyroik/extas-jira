<?php
namespace extas\interfaces\jira\issues\changelog;

use extas\interfaces\IHasId;
use extas\interfaces\IItem;
use extas\interfaces\jira\issues\fields\ICreated;
use extas\interfaces\jira\issues\fields\IField;
use extas\interfaces\jira\issues\fields\IUser;

/**
 * Interface IHistory
 *
 * @package extas\interfaces\jira\issues\changelog
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHistory extends IItem, IHasId
{
    public const SUBJECT = 'extas.jira.issue.changelog.history';

    public const FIELD__AUTHOR = 'author';
    public const FIELD__ITEMS = 'items';
    public const FIELD__CREATED = 'created';

    /**
     * @return IUser|IField
     */
    public function getAuthor(): IField;

    /**
     * @return array
     */
    public function getItems(): array;

    /**
     * @return ICreated|IField
     */
    public function getCreated(): IField;
}
