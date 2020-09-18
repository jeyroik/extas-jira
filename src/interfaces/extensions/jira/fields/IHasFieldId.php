<?php
namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldId
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldId
{
    public const PARAM__FIELD_ID = 'id';

    /**
     * @return int
     */
    public function getFieldId(): int;
}
