<?php
/**
 * Created by PhpStorm.
 * User: shaman
 * Date: 10/30/18
 * Time: 9:28 AM
 */

namespace shaman\interfaces;

/**
 * Interface Request
 * @package shaman\interfaces
 */
interface Request
{
    /**
     * Return authorization token
     *
     * @return null|string
     */
    public static function getAuthorization();

    /**
     * Return list of headers
     *
     * @return array
     */
    public static function getHeaders(): array;

    /**
     * Return header by name
     *
     * @param string $name
     *
     * @return string|null
     */
    public static function getHeader(string $name);

    /**
     * Return current query string without get params
     *
     * @return string
     */
    public static function getQueryString(): string;

    /**
     * Return current http method
     *
     * @return string
     */
    public static function getMethod(): string;

    /**
     * Return current http referer
     *
     * @return null|string
     */
    public static function getReferer();

    /**
     * Return current user agent
     *
     * @return string
     */
    public static function getUserAgent(): string;

    /**
     * Return current content type
     *
     * @return string
     */
    public static function getContentType(): string;

    /**
     * Return current body without some process
     *
     * @return array|null|string
     */
    public static function getRawBody();

    /**
     * Return body params in array type or null
     *
     * @param string $name
     *
     * @return null|array
     */
    public static function put(string $name = '');

    /**
     * Return post param by name or all params
     *
     * @param string $name
     *
     * @return null|array|string
     */
    public static function post(string $name = '');

    /**
     * Return all query params
     *
     * @return array
     */
    public static function queryParams(): array;

    /**
     * Return query param by name
     *
     * @param string $name
     *
     * @return null|string|array
     */
    public static function queryParam(string $name);
}
