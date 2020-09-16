<?php
namespace extas\interfaces\jira;

/**
 * Interface IHasSelf
 *
 * @package extas\interfaces\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasSelf
{
    public const FIELD__SELF = 'self';

    /**
     * @return string
     */
    public function getSelf(): string;
}
