<?php
namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldSelf
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldSelf
{
    public const PARAM__FIELD_SELF = 'self';

    /**
     * @return string
     */
    public function getFieldSelf(): string;
}
