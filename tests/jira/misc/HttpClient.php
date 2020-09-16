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
            'issues' => [
                [
                    'key' => 'JRK-1',
                    'self' => $uri
                ]
            ]
        ]));

        return $response;
    }
}
