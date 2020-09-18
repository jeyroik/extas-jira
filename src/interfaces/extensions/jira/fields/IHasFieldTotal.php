<?php

namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldTotal
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldTotal
{
    public const PARAM__FIELD_TOTAL = 'total';

    /**
     * @return int
     */
    public function getFieldTotal(): int;
}
