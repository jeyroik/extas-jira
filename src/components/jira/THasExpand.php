<?php
namespace extas\components\jira;

use extas\interfaces\jira\IHasExpand;

/**
 * Trait THasExpand
 *
 * @property array $config
 *
 * @package extas\components\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasExpand
{
    /**
     * @return array
     */
    public function getExpand(): array
    {
        $expand = $this->config[IHasExpand::FIELD__EXPAND] ?? '';
        $expands = explode(',', $expand);
        foreach ($expands as $index => $expand) {
            $expands[$index] = trim(strtolower($expand));
        }

        return $expands;
    }
}
