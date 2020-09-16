<?php
namespace extas\interfaces\extensions\jira\uri;

use extas\interfaces\jira\IUri;

/**
 * Interface IExtensionExpand
 *
 * @package extas\interfaces\extensions\terms\jira\uri
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IExtensionExpand
{
    /**
     * @param array $expands
     * @return IUri
     */
    public function expand(array $expands);
}
