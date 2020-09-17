<?php
namespace extas\components\jira\issues;

use extas\components\exceptions\MissedOrUnknown;
use extas\components\jira\JiraRepository;
use extas\components\jira\results\issues\SearchResult;
use extas\interfaces\jira\results\issues\ISearchResult;
use extas\interfaces\repositories\IRepository;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class IssueRepository
 *
 * @package extas\components\jira\issues
 * @author jeyroik <jeyroik@gmail.com>
 */
class IssueRepository extends JiraRepository
{
    public const ENV__SCOPE = 'EXTAS__JIRA_SEARCH_ISSUE_SCOPE';

    /**
     * IssueRepository constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $config[static::OPTION__REPOSITORY_SCOPE] = getenv(static::ENV__SCOPE) ?: 'rest/api/2/search';
        $config[static::OPTION__ITEM_CLASS] = Issue::class;
        $config[static::FIELD__RESULT_CLASS_GET] = SearchResult::class;

        parent::__construct($config);
    }

    /**
     * @param $where
     * @param int $offset
     * @param array $fields
     * @return ISearchResult|null
     * @throws GuzzleException
     * @throws MissedOrUnknown
     */
    public function one($where, int $offset = 0, array $fields = [])
    {
        /**
         * @var ISearchResult $result
         */
        $result = $this->get($where, $offset, 1, [], $fields);

        if ($result->getTotal()) {
            return $result;
        }

        return null;
    }

    /**
     * @param $where
     * @param int $limit
     * @param int $offset
     * @param array $orderBy
     * @param array $fields
     * @return ISearchResult
     * @throws MissedOrUnknown
     */
    public function all($where, int $limit = 0, int $offset = 0, array $orderBy = [], array $fields = [])
    {
        /**
         * @var ISearchResult $result
         */
        return $this->get($where, $offset, $limit, $orderBy, $fields);
    }

    /**
     * @param $item
     * @return mixed|void
     * @throws \Exception
     */
    public function create($item)
    {
        throw new \Exception('Method is not implemented yet');
    }

    /**
     * @param $item
     * @param array $where
     * @return int
     * @throws \Exception
     */
    public function update($item, $where = []): int
    {
        throw new \Exception('Method is not implemented yet');
    }

    /**
     * @param $where
     * @param null $item
     * @return int
     * @throws \Exception
     */
    public function delete($where, $item = null): int
    {
        throw new \Exception('Method is not implemented yet');
    }

    /**
     * @param array $byFields
     * @return IRepository
     * @throws \Exception
     */
    public function group(array $byFields): IRepository
    {
        throw new \Exception('Method is not implemented yet');
    }
}
