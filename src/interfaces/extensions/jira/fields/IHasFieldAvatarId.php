<?php

namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldAvatarId
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldAvatarId
{
    public const PARAM__FIELD_AVATAR_ID = 'avatarId';

    /**
     * @return int
     */
    public function getFieldAvatarId(): int;
}
