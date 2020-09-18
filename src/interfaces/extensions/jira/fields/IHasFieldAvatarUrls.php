<?php
namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldAvatarUrls
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldAvatarUrls
{
    public const PARAM__FIELD_AVATAR_URLS = 'avatarUrls';

    /**
     * @return array
     */
    public function getFieldAvatarUrls(): array;
}
