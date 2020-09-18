<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldId;
use extas\interfaces\extensions\jira\fields\IHasFieldName;
use extas\interfaces\extensions\jira\fields\IHasFieldSelf;

/**
 * Interface ILinkType
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface ILinkType extends IHasFieldId, IHasFieldName, IHasFieldSelf
{
    public const PARAM__FIELD_INWARD = 'inward';
    public const PARAM__FIELD_OUTWARD = 'outward';

    /**
     * @return string
     */
    public function getInward(): string;

    /**
     * @return string
     */
    public function getOutward(): string;
}
