<?php
namespace extas\components\jira\results\issues;

use extas\components\Item;
use extas\components\jira\results\THasIssues;
use extas\components\jira\results\THasMaxResults;
use extas\components\jira\results\THasNames;
use extas\components\jira\results\THasSchema;
use extas\components\jira\results\THasStartAt;
use extas\components\jira\results\THasTotal;
use extas\components\jira\THasExpand;
use extas\interfaces\jira\results\issues\ISearchResult;

/**
 * Class ResultSearch
 *
 * @package extas\components\jira\results\issues
 * @author jeyroik <jeyroik@gmail.com>
 */
class SearchResult extends Item implements ISearchResult
{
    use THasExpand;
    use THasIssues;
    use THasMaxResults;
    use THasNames;
    use THasStartAt;
    use THasTotal;
    use THasSchema;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
