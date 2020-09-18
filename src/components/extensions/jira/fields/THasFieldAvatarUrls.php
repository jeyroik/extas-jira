<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldAvatarUrls;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldAvatarUrls
 *
 * @package extas\components\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldAvatarUrls
{
    /**
     * @param IField|null $field
     * @return array
     */
    public function getFieldAvatarUrls(IField $field = null): array
    {
        return $field->getParameterValue(IHasFieldAvatarUrls::PARAM__FIELD_AVATAR_URLS, []);
    }
}
