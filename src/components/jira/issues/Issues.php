<?php
namespace extas\components\jira\issues;

use extas\components\Item;
use extas\components\jira\results\THasIssues;
use extas\components\jira\results\THasNames;
use extas\components\jira\results\THasSchema;
use extas\interfaces\jira\issues\IIssue;
use extas\interfaces\jira\issues\IIssues;

/**
 * Class Issues
 *
 * @package extas\interfaces\jira\issues
 * @author jeyroik <jeyroik@gmail.com>
 */
class Issues extends Item implements IIssues
{
    use THasNames;
    use THasSchema;
    use THasIssues;

    /**
     * @return bool
     */
    public function valid()
    {
        $issues = $this->getIssues();

        return isset($issues[$this->currentKey]);
    }

    /**
     * @return IIssue|mixed|null
     */
    public function current()
    {
        $issues = $this->getIssues();

        return $issues[$this->currentKey];
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->config[static::FIELD__ISSUES]);
    }

    /**
     * @return array
     */
    public function getFieldsNames(): array
    {
        return $this->getNames();
    }

    /**
     * @return array
     */
    public function getFieldsSchema(): array
    {
        return $this->getSchema();
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
