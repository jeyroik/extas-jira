<?php
namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IExtensionProject
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IExtensionProject
{
    public const FIELD__PROJECT_SELF = 'self';
    public const FIELD__PROJECT_ID = 'id';
    public const FIELD__PROJECT_KEY = 'key';
    public const FIELD__PROJECT_NAME = 'name';
    public const FIELD__PROJECT_TYPE_KEY = 'projectTypeKey';
    public const FIELD__PROJECT_AVATAR_URLS = 'avatarUrls';

    /**
     * @return string
     */
    public function getProjectSelf(): string;

    /**
     * @return int
     */
    public function getProjectId(): int;

    /**
     * @return string
     */
    public function getProjectKey(): string;

    /**
     * @return string
     */
    public function getProjectName(): string;

    /**
     * @return string
     */
    public function getProjectTypeKey(): string;

    /**
     * @return array
     */
    public function getProjectAvatarUrls(): array;
}