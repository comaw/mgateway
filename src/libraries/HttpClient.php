<?php
/**
 * Created by PhpStorm.
 * User: shaman
 * Date: 10/30/18
 * Time: 11:00 AM
 */

namespace shaman\libraries;

use GuzzleHttp\Client;

/**
 * Class HttpClient
 * @package shaman\libraries
 */
class HttpClient implements \shaman\interfaces\HttpClient
{
    #region [private constants]
    private const CONNECT_TIMEOUT = 10; // in seconds
    #endregion

    #region [private properties]
    /** @var Client $http */
    private $http;
    /** @var mixed|\Psr\Http\Message\ResponseInterface $response */
    private $response;
    /** @var string $baseUri */
    private $baseUri = '';
    #endregion

    #region [constructor]
    /**
     * HttpClient constructor.
     *
     * @param string $apiUrl
     */
    public function __construct(string $apiUrl)
    {
        $this->baseUri = rtrim($apiUrl, '/');
        $this->http    = new Client();
    }
    #endregion

    #region [public methods]
    /**
     * @return $this
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request()
    {
        $contentType = Request::getContentType();
        $options     = $this->setOptions([], $contentType);
        $options     = $this->setPostData($options, $contentType);

        $this->response = $this->http->request(Request::getMethod(), $this->baseUri . Request::getQueryString(), $options);

        return $this;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function response()
    {
        return $this->response;
    }
    #endregion

    #region [private methods]
    /**
     * @param array $options
     * @param string $contentType
     *
     * @return array
     */
    private function setOptions(array $options, string $contentType): array
    {
        $options = [
            'body'            => Request::getRawBody(),
            'connect_timeout' => self::CONNECT_TIMEOUT,
            'headers'         => [
                'Authorization' => Request::getHeader('Authorization'),
                'User-Agent'    => Request::getHeader('User-Agent'),
            ],
            'verify'          => false,
            'query'           => Request::queryParams(),
            'content-type'    => $contentType,
            'http_errors'     => false,
        ];

        return $options;
    }

    /**
     * @param array $options
     * @param string $contentType
     *
     * @return array
     */
    private function setPostData(array $options, string $contentType): array
    {
        if ($contentType == 'application/x-www-form-urlencoded') {
            $options['form_params'] = Request::post();
        }
        if ($contentType == 'multipart/form-data form') {
            foreach (Request::post() as $name => $value) {
                $options['multipart'][] = [
                    'name'     => $name,
                    'contents' => $value,
                ];
            }
        }

        return $options;
    }
    #endregion
}
