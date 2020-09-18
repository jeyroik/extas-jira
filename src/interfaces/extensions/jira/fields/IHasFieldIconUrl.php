<?php
namespace extas\interfaces\extensions\jira\fields;

/**
 * Interface IHasFieldIconUrl
 *
 * @package extas\interfaces\extensions\jira\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFieldIconUrl
{
    public const PARAM__FIELD_ICON_URL = 'iconUrl';

    /**
     * @return string
     */
    public function getFieldIconUrl(): string;
}
