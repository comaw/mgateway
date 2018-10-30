<?php
/**
 * Created by PhpStorm.
 * User: shaman
 * Date: 10/30/18
 * Time: 9:28 AM
 */

namespace shaman\libraries;

/**
 * Class Request
 * @package shaman\libraries
 */
class Request implements \shaman\interfaces\Request
{
    #region [private constants]
    private const DEFAULT_USER_AGENT = 'gateway_user_agent';
    #endregion

    #region [private static properties]
    /** @var null|string|array $body */
    private static $body = null;
    #endregion

    #region [public static methods]
    /**
     * @return null|string
     */
    public static function getAuthorization()
    {
        return static::getHeader( 'AUTHORIZATION');
    }

    /**
     * @return array
     */
    public static function getHeaders(): array
    {
        return self::getHeaderList();
    }

    /**
     * @param string $name
     *
     * @return string|null
     */
    public static function getHeader(string $name)
    {
        return static::getHeaders()[$name] ?? null;
    }

    /**
     * @return string
     */
    public static function getQueryString(): string
    {
        $queryString = str_replace('index.php', '', ($_SERVER['REQUEST_URI'] ?? '/'));
        $queryString = explode('?', $queryString);

        return current($queryString);
    }

    /**
     * @return string
     */
    public static function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    /**
     * @return null|string
     */
    public static function getReferer()
    {
        return $_SERVER['HTTP_REFERER'] ?? null;
    }

    /**
     * @return string
     */
    public static function getUserAgent(): string
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? self::DEFAULT_USER_AGENT;
    }

    /**
     * @return string
     */
    public static function getContentType(): string
    {
        return $_SERVER["CONTENT_TYPE"] ?? 'application/json';
    }

    /**
     * @return array|null|string
     */
    public static function getRawBody()
    {
        if (!self::$body) {
            self::getBody();
        }
        if (!self::$body) {
            return null;
        }

        return self::$body;
    }

    /**
     * @param string $name
     *
     * @return null|array
     */
    public static function put(string $name = '')
    {
        if (!self::$body) {
            self::getBody();
        }
        if (!self::$body) {
            return null;
        }

        parse_str(self::$body, $return);

        if ($name) {
            return $return[$name] ?? null;
        }

        return $return;
    }

    /**
     * @param string $name
     *
     * @return null|array|string
     */
    public static function post(string $name = '')
    {
        if ($name) {
            return $_POST[$name] ?? null;
        }

        return $_POST;
    }

    /**
     *
     * @return array
     */
    public static function queryParams(): array
    {
        if (isset($_GET['_url'])) {
            unset($_GET['_url']);
        }

        return $_GET;
    }

    /**
     * @param string $name
     *
     * @return null|string|array
     */
    public static function queryParam(string $name)
    {
        return $_GET[$name] ?? null;
    }
    #endregion

    #region [private static methods]
    /**
     * @return array|bool|null|string
     */
    private static function getBody()
    {
        self::$body = file_get_contents('php://input');

        return self::$body;
    }

    /**
     * @return array
     */
    private static function getHeaderList(): array
    {
        $headerList = [];
        foreach ($_SERVER as $name => $value) {
            if (preg_match('/^HTTP_/',$name)) {
                // convert HTTP_HEADER_NAME to HEADER_NAME
                $name = (strtr(substr($name,5),'_',' '));
                $name = ucwords(strtolower($name));
                $name = strtr($name,' ','-');
                $headerList[$name] = $value;
            }
        }

        return $headerList;
    }
    #endregion

    #region [constructor]
    /**
     * Request constructor.
     */
    private function __construct()
    {

    }
    #endregion

    #region [private magic methods]
    /**
     *  implement clone functionality
     */
    private function __clone()
    {
        return;
    }
    #endregion
}
