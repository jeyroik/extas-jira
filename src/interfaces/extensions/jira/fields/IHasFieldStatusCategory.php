<?php

namespace extas\interfaces\extensions\jira\fields;

use extas\interfaces\jira\issues\fields\IStatusCategory;

/**
 * Interface IHasFieldStatusCategory
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldStatusCategory
{
    public const PARAM__FIELD_STATUS_CATEGORY = 'statusCategory';

    /**
     * @return IStatusCategory|mixed
     */
    public function getFieldStatusCategory();
}
