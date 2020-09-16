<?php
namespace tests\jira\misc;

use extas\components\http\TSnuffHttp;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class HttpClient
 *
 * @package tests\jira\misc
 * @author jeyroik <jeyroik@gmail.com>
 */
class HttpClient extends Client
{
    use TSnuffHttp;

    /**
     * @param UriInterface $uri
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($uri, array $options = []): ResponseInterface
    {
        $response = $this->getPsrResponse();
        $response->getBody()->write(json_encode([
            'expand' => 'names,schema',
            'startAt' => 1,
            'maxResults' => 1,
            'total' => 314,
            'issues' => [
                [
                    'key' => 'JRK-1',
                    'expand' => 'operations,versionedRepresentations,editmeta,changelog,renderedFields',
                    'self' => $uri,
                    'fields' => [
                    ]
                ]
            ],
            'names' => [
                'customfield_1290' => 'Test'
            ],
            'schema' => [
                'customfield_1290' => [
                    'type' => 'string',
                    'custom' => 'com.atlassian.jira.plugin.system.customfieldtypes:textfield',
                    'customId' => 11200
                ]
            ]
        ]));

        return $response;
    }
}
