<?php
namespace extas\interfaces\jira;

/**
 * Interface IHasKey
 *
 * @package extas\interfaces\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasKey
{
    public const FIELD__KEY = 'key';

    /**
     * @return mixed
     */
    public function getKey(): string;
}
