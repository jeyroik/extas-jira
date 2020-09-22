<?php
namespace extas\components\extensions\jira\fields;

use extas\components\jira\issues\fields\IssueLink;
use extas\interfaces\extensions\jira\fields\IHasFieldValue;
use extas\interfaces\jira\issues\fields\IField;
use extas\interfaces\jira\issues\fields\IIssueLink;

/**
 * Trait THasFieldIssueLinks
 *
 * @package extas\components\extensions\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFieldIssueLinks
{
    /**
     * @param IField|null $field
     * @return IIssueLink[]
     */
    public function getFieldLinks(IField $field = null): array
    {
        $linksData = $field->getParameterValue(IHasFieldValue::PARAM__FIELD_VALUE, []);
        $links = [];

        foreach ($linksData as $link) {
            $links[] = new IssueLink($link);
        }

        return $links;
    }
}
