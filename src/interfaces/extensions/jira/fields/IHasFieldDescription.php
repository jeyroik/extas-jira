<?php

namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldDescription
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldDescription
{
    public const PARAM__FIELD_DESCRIPTION = 'description';

    /**
     * @return string
     */
    public function getFieldDescription(): string;
}
