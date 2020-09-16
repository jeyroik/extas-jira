<?php
namespace extas\components\jira;

use extas\components\exceptions\MissedOrUnknown;
use extas\components\Item;
use extas\interfaces\extensions\jira\uri\IExtensionExpand;
use extas\interfaces\jira\IJiraClient;
use extas\interfaces\jira\IJIraRepository;
use extas\interfaces\jira\IJql;
use extas\interfaces\jira\IUri;
use extas\interfaces\jira\results\IHasMaxResults;
use extas\interfaces\jira\results\IHasStartAt;
use extas\components\secrets\Secret;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\secrets\ISecret;

/**
 * Class JiraRepository
 *
 * @method IRepository secrets()
 *
 * @package extas\components\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
abstract class JiraRepository extends Item implements IJIraRepository
{
    /**
     * @param $where
     * @param int $offset
     * @param int $limit
     * @param array $orderBy [field, ASC|DESC]
     * @param array $fields
     * @return mixed
     * @throws MissedOrUnknown
     */
    protected function get($where, int $offset = 0, int $limit = 0, array $orderBy = [], array $fields = [])
    {
        $client = $this->getClient();

        /**
         * @var IExtensionExpand|IUri $uri
         */
        $uri = new Uri([Uri::FIELD__PATH => $this->getScope()]);

        $this->appendOrderBy($where, $orderBy);

        $where instanceof IJql
            ? $uri->add('jql', urlencode($where->__toString()))
            : $uri->addParams($where);

        $uri->add(IHasStartAt::FIELD__START_AT, $offset);

        $limit && $uri->add(IHasMaxResults::FIELD__MAX_RESULTS, $limit);
        !empty($fields) && $uri->expand($fields);

        return $this->getResult($client->get($uri));
    }

    /**
     * @return string
     */
    public function getPk(): string
    {
        return $this->config[static::OPTION__COLLECTION_UID] ?? '';
    }

    /**
     * @return string
     */
    public function getItemClass(): string
    {
        return $this->config[static::OPTION__ITEM_CLASS] ?? '';
    }

    /**
     * @return string
     */
    public function getScope(): string
    {
        return $this->config[static::OPTION__REPOSITORY_SCOPE] ?? '';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->config[static::OPTION__REPOSITORY_NAME] ?? '';
    }

    /**
     * @param array $result
     * @return \|mixed
     * @throws MissedOrUnknown
     */
    public function getResult(array $result)
    {
        return $this->constructResult($result, static::FIELD__RESULT_CLASS_GET);
    }

    /**
     * @param array $result
     * @return \|mixed
     * @throws MissedOrUnknown
     */
    public function postResult(array $result)
    {
        return $this->constructResult($result, static::FIELD__RESULT_CLASS_POST);
    }

    /**
     * @param array $result
     * @return \|mixed
     * @throws MissedOrUnknown
     */
    public function putResult(array $result)
    {
        return $this->constructResult($result, static::FIELD__RESULT_CLASS_PUT);
    }

    /**
     * @param array $result
     * @return \|mixed
     * @throws MissedOrUnknown
     */
    public function deleteResult(array $result)
    {
        return $this->constructResult($result, static::FIELD__RESULT_CLASS_DELETE);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function drop(): bool
    {
        throw new \Exception('Method is not allowed');
    }

    /**
     * @param mixed $where
     * @param array $orderBy
     * @return IJql|mixed
     */
    protected function appendOrderBy($where, array $orderBy)
    {
        if (empty($orderBy)) {
            $orderBy = ['id', 'desc'];
        }

        $orderMap = [-1 => 'desc', 1 => 'asc'];

        list($field, $order) = $orderBy;

        $where instanceof IJql
            ? $where->orderBy($field, $orderMap[$order] ?? 'desc')
            : $where[] = 'ORDER BY ' . implode(' ', $orderBy);

        return $where;
    }

    /**
     * @return JiraClient
     * @throws MissedOrUnknown
     */
    protected function getClient(): IJiraClient
    {
        /**
         * @var ISecret $secret
         */
        $secret = $this->secrets()->one([
            Secret::FIELD__TARGET => static::SERVICE__NAME,
            Secret::FIELD__NAME => $this->getName()
        ]);

        if (!$secret) {
            throw new MissedOrUnknown('Jira instance "' . $this->getName() . '" secret');
        }

        $secret->setParameterValue('password', $this->getSecretPassword());
        $decrypted = $secret->decrypt();
        if (!$decrypted) {
            throw new \Exception('Can not decrypt Jira instance "' . $this->getName() . '" config');
        }

        $settings = json_decode($secret->getValue(), true);

        $client = new JiraClient([
            JiraClient::FIELD__CREDENTIALS => $settings['credentials'] ?? [],
            JiraClient::FIELD__BASE_URL => $settings['base_url'] ?? ''
        ]);

        return $client;
    }

    /**
     * @return string
     */
    protected function getSecretPassword(): string
    {
        return $this->config[static::FIELD__SECRET_PASSWORD] ?? '';
    }

    /**
     * @param array $result
     * @param string $resultFieldName
     * @return \|mixed
     * @throws MissedOrUnknown
     */
    protected function constructResult(array $result, string $resultFieldName)
    {
        $class = $this->config[$resultFieldName] ?? '';

        if (!$class) {
            throw new MissedOrUnknown($resultFieldName . ' result class');
        }

        return new $class($result);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
