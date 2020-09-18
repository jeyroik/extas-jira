<?php

namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldEmailAddress
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldEmailAddress
{
    public const PARAM__FIELD_EMAIL_ADDRESS = 'emailAddress';

    /**
     * @return string
     */
    public function getFieldEmailAddress(): string;
}
