<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldId;
use extas\interfaces\extensions\jira\fields\IHasFieldKey;
use extas\interfaces\extensions\jira\fields\IHasFieldName;
use extas\interfaces\extensions\jira\fields\IHasFieldSelf;

/**
 * Interface IStatusCategory
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IStatusCategory extends IField, IHasFieldId, IHasFieldName, IHasFieldSelf, IHasFieldKey
{
    public const PARAM__COLOR_NAME = 'colorName';

    /**
     * @return string
     */
    public function getFieldColorName(): string;
}
