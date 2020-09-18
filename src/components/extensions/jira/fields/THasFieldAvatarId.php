<?php
namespace extas\components\extensions\jira\fields;

use extas\interfaces\extensions\jira\fields\IHasFieldAvatarId;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Trait THasFieldAvatarId
 *
 * @package extas\components\extensions\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldAvatarId
{
    /**
     * @param IField|null $field
     * @return int
     */
    public function getFieldAvatarId(IField $field = null): int
    {
        return $field->getParameterValue(IHasFieldAvatarId::PARAM__FIELD_AVATAR_ID, 0);
    }
}
