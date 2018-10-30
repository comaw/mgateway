<?php
/**
 * Created by PhpStorm.
 * User: shaman
 * Date: 10/30/18
 * Time: 8:53 AM
 */

namespace shaman;

use shaman\interfaces\Config as ConfigInterface;
use shaman\libraries\Config;
use shaman\libraries\HttpClient;

/**
 * Class Gateway
 * @package shaman
 */
class Gateway
{
    /** @var ConfigInterface $config */
    protected $config;

    /**
     * Gateway constructor.
     *
     * @param string $path
     *
     * @throws \Exception
     */
    public function __construct(string $path = '')
    {
        $this->config = new Config($path);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send()
    {
        return (new HttpClient($this->config->getSetting('apiUrl') ?? ''))->request()->response();
    }
}
