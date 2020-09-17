<?php
namespace extas\components\extensions\jira\fields;

use extas\components\extensions\Extension;
use extas\interfaces\extensions\jira\fields\IExtensionProject;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Class ExtensionProject
 *
 * @package extas\components\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
class ExtensionProject extends Extension implements IExtensionProject
{
    /**
     * @param IField|null $field
     * @return string
     */
    public function getProjectSelf(IField $field = null): string
    {
        return $field->getParameterValue(static::FIELD__PROJECT_SELF, '');
    }

    /**
     * @param IField|null $field
     * @return string
     */
    public function getProjectKey(IField $field = null): string
    {
        return $field->getParameterValue(static::FIELD__PROJECT_KEY, '');
    }

    /**
     * @param IField|null $field
     * @return array
     */
    public function getProjectAvatarUrls(IField $field = null): array
    {
        return $field->getParameterValue(static::FIELD__PROJECT_AVATAR_URLS, []);
    }

    /**
     * @param IField|null $field
     * @return int
     */
    public function getProjectId(IField $field = null): int
    {
        return $field->getParameterValue(static::FIELD__PROJECT_ID, '');
    }

    /**
     * @param IField|null $field
     * @return string
     */
    public function getProjectName(IField $field = null): string
    {
        return $field->getParameterValue(static::FIELD__PROJECT_NAME, '');
    }

    /**
     * @param IField|null $field
     * @return string
     */
    public function getProjectTypeKey(IField $field = null): string
    {
        return $field->getParameterValue(static::FIELD__PROJECT_TYPE_KEY, '');
    }
}
