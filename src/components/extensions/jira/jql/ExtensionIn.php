<?php
namespace extas\components\extensions\jira\jql;

use extas\components\extensions\Extension;
use extas\interfaces\extensions\jira\jql\IExtensionIn;
use extas\interfaces\jira\IJql;

/**
 * Class ExtensionIn
 *
 * @package extas\components\extensions\terms\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
class ExtensionIn extends Extension implements IExtensionIn
{
    /**
     * @param string $fieldName
     * @param array $values
     * @param IJql|null $jql
     * @return IJql
     */
    public function andIn(string $fieldName, array $values, IJql $jql = null): IJql
    {
        $jql->andCondition($fieldName, 'in', '(' . implode(',', $values) . ')');

        return $jql;
    }
}
