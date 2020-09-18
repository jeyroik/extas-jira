<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\jira\issues\fields\IField;
use extas\interfaces\extensions\jira\fields\IHasFieldIconUrl;

/**
 * Trait THasFieldIconUrl
 *
 * @package extas\components\extensions\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldIconUrl
{
    /**
     * @param IField|null $field
     * @return string
     */
    public function getFieldIconUrl(IField $field = null): string
    {
        return $field->getParameterValue(IHasFieldIconUrl::PARAM__FIELD_ICON_URL, 0);
    }
}
