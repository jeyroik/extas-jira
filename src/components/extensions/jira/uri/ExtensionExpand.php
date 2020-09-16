<?php
namespace extas\components\extensions\jira\uri;

use extas\components\extensions\Extension;
use extas\interfaces\extensions\jira\uri\IExtensionExpand;
use extas\interfaces\jira\IUri;

/**
 * Class ExtensionExpand
 *
 * @package extas\components\extensions\jira\uri
 * @author jeyroik <jeyroik@gmail.com>
 */
class ExtensionExpand extends Extension implements IExtensionExpand
{
    /**
     * @param array $expands
     * @param IUri|null $uri
     * @return IUri|null
     */
    public function expand(array $expands, IUri $uri = null)
    {
        $uri->add('expand', implode(',', $expands));

        return $uri;
    }
}
