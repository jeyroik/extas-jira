<?php

namespace extas\interfaces\extensions\jira\fields;

use extas\interfaces\jira\issues\fields\ILinkType;

/**
 * Interface IHasFieldLinkType
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldLinkType
{
    public const PARAM__FIELD_LINK_TYPE = 'type';

    /**
     * @return ILinkType
     */
    public function getFieldLinkType(): ILinkType;
}
