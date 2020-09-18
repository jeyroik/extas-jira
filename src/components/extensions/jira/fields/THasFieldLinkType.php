<?php
namespace extas\components\extensions\jira\fields;

use extas\components\jira\issues\fields\LinkType;
use extas\interfaces\extensions\jira\fields\IHasFieldKey;
use extas\interfaces\extensions\jira\fields\IHasFieldLinkType;
use extas\interfaces\jira\issues\fields\IField;
use extas\interfaces\jira\issues\fields\ILinkType;

/**
 * Trait THasFieldLinkType
 *
 * @package extas\components\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldLinkType
{
    /**
     * @param IField|null $field
     * @return ILinkType
     */
    public function getFieldLinkType(IField $field = null): ILinkType
    {
        $type = $field->getParameterValue(IHasFieldLinkType::PARAM__FIELD_LINK_TYPE, []);

        return new LinkType($type);
    }
}
