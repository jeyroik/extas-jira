<?php
namespace extas\interfaces\extensions\jira\jql;

use extas\interfaces\jira\IJql;

/**
 * Interface ExtensionIn
 * @package extas\interfaces\extensions\terms\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IExtensionIn
{
    /**
     * @param string $fieldName
     * @param array $values
     * @return IJql
     */
    public function andIn(string $fieldName, array $values): IJql;
}
