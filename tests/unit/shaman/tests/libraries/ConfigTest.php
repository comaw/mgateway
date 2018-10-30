<?php

namespace shaman\tests\libraries;

use shaman\libraries\Config;

/**
 * Class ConfigTest
 * @package shaman\libraries
 */
class ConfigTest extends \Codeception\Test\Unit
{
    /** @var Config $config */
    protected $config;
    /** @var string $configFilePath */
    protected $configFilePath = '/../../../../_data/settings.json';
    /** @var array $mockConfig */
    protected $mockConfig = ['apiUrl' => 'http://api.local/'];

    /**
     * @throws \Exception
     */
    protected function _before()
    {
        $this->config = new Config(__DIR__ . $this->configFilePath);
    }

    /**
     * test get settings
     */
    public function testGetSettings()
    {
        $this->assertEquals($this->mockConfig, $this->config->getSettings());
        $this->assertEquals($this->mockConfig['apiUrl'], $this->config->getSetting('apiUrl'));
    }
}
