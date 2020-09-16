<?php
namespace extas\interfaces\jira;

/**
 * Interface IHasExpand
 *
 * @package extas\interfaces\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasExpand
{
    public const FIELD__EXPAND = 'expand';

    /**
     * @return array
     */
    public function getExpand(): array;
}
