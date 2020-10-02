<?php
namespace extas\components\jira\results\issues;

use extas\components\Item;
use extas\components\jira\issues\fields\Field;
use extas\components\jira\results\THasIssues;
use extas\components\jira\results\THasMaxResults;
use extas\components\jira\results\THasNames;
use extas\components\jira\results\THasSchema;
use extas\components\jira\results\THasStartAt;
use extas\components\jira\results\THasTotal;
use extas\components\jira\THasExpand;
use extas\interfaces\jira\issues\IIssue;
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
     * Issues constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->isEnrichIssues() && $this->enrichIssues();
    }

    /**
     * @return bool
     */
    public function isEnrichIssues(): bool
    {
        return $this->config[static::FIELD__IS_ENRICH_ISSUES] ?? true;
    }

    protected function enrichIssues(): void
    {
        $issues = $this->getIssues();
        $names = $this->getNames();
        $schemaList = $this->getSchema();

        foreach ($issues as $index => $issue) {
            $issue[IIssue::FIELD__FIELDS] = $this->enrichFields($issue->getFields(), $names, $schemaList);
            $issues[$index] = $issue->__toArray();
        }

        $this[static::FIELD__ISSUES] = $issues;
    }

    /**
     * @param array $fields
     * @param array $names
     * @param array $schemaList
     * @return array
     */
    protected function enrichFields(array $fields, array $names, array $schemaList): array
    {
        foreach ($fields as $name => $field) {
            $detailed = new Field([
                Field::FIELD__NAME => $name,
                Field::FIELD__SCHEMA => $schemaList[$name]->__toArray(),
                Field::FIELD__TITLE => $names[$name],
                Field::FIELD__DESCRIPTION => $names[$name]
            ]);
            $detailed->addParametersByValues($field->__toArray());
            $fields[$name] = $detailed->__toArray();
        }

        return $fields;
    }

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
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
