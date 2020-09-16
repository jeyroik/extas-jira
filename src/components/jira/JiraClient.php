<?php
namespace extas\components\jira;

use extas\components\exceptions\MissedOrUnknown;
use extas\components\Item;
use extas\components\jira\results\ResultSearch;
use extas\interfaces\jira\IJiraClient;
use extas\interfaces\jira\IUri;
use extas\interfaces\jira\results\IResultSearch;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

/**
 * Class JiraClient
 *
 * @method Client httpClient()
 *
 * @package extas\components\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
class JiraClient extends Item implements IJiraClient
{
    /**
     * @param IUri $uri
     * @return array
     */
    public function get(IUri $uri): array
    {
        $client = $this->httpClient();

        $response = $client->get($this->getBaseUrl() . $uri->__toString(), [
            'auth' => $this->getCredentials()
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->config[static::FIELD__BASE_URL] ?? '';
    }

    /**
     * @return array
     */
    public function getCredentials(): array
    {
        return $this->config[static::FIELD__CREDENTIALS] ?? [];
    }

    /**
     * @return ClientInterface
     * @throws MissedOrUnknown
     */
    public function getHttpClient(): ClientInterface
    {
        if (!isset($this->config[static::FIELD__HTTP_CLIENT])) {
            throw new MissedOrUnknown('http client');
        }

        return $this->config[static::FIELD__HTTP_CLIENT];
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
