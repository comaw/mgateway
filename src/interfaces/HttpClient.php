<?php
/**
 * Created by PhpStorm.
 * User: shaman
 * Date: 10/30/18
 * Time: 11:47 AM
 */

namespace shaman\interfaces;

/**
 * Interface HttpClient
 * @package shaman\interfaces
 */
interface HttpClient
{
    /**
     * @return HttpClient
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request();

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function response();
}
