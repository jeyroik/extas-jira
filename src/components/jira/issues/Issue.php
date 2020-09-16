<?php
namespace extas\components\jira\issues;

use extas\components\Item;
use extas\components\jira\THasExpand;
use extas\components\jira\THasKey;
use extas\components\jira\THasSelf;
use extas\components\THasId;
use extas\interfaces\jira\issues\IIssue;

/**
 * Class Issue
 *
 * @package extas\components\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
class Issue extends Item implements IIssue
{
    use THasId;
    use THasExpand;
    use THasKey;
    use THasSelf;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
