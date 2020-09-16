<?php
namespace extas\interfaces\jira;

use extas\interfaces\IItem;
use extas\interfaces\jira\results\IResultSearch;
use GuzzleHttp\ClientInterface;

/**
 * Interface IJiraClient
 *
 * @package extas\interfaces\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IJiraClient extends IItem
{
    public const SUBJECT = 'extas.jira.client';

    public const FIELD__BASE_URL = 'base_url';
    public const FIELD__CREDENTIALS = 'credentials';
    public const FIELD__CREDENTIALS_LOGIN = 'login';
    public const FIELD__CREDENTIALS_PASSWORD = 'password';
    public const FIELD__CREDENTIALS_TOKEN = 'token';
    public const FIELD__HTTP_CLIENT = 'http_client';

    /**
     * @return string
     */
    public function getBaseUrl(): string;

    /**
     * @return array
     */
    public function getCredentials(): array;

    /**
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface;
}
