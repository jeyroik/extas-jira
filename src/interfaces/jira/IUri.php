<?php
namespace extas\interfaces\jira;

use extas\interfaces\IHasPath;
use extas\interfaces\IItem;

/**
 * Interface IUri
 *
 * @package extas\interfaces\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IUri extends IItem, IHasPath
{
    public const SUBJECT = 'extas.jira.uri';

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function add(string $name, string $value);

    /**
     * @param array $params
     * @return $this
     */
    public function addParams(array $params);
}
