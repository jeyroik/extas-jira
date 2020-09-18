<?php
namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldValue
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldValue
{
    public const PARAM__FIELD_VALUE = 'value';

    /**
     * @return mixed
     */
    public function getFieldValue();
}
