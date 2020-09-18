<?php
namespace extas\interfaces\jira\issues\fields;

/**
 * Interface IAssignee
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IAssignee extends IUser
{
    public const NAME = 'assignee';
}
