<?php
/**
 * Created by PhpStorm.
 * User: shaman
 * Date: 10/30/18
 * Time: 8:57 AM
 */

namespace shaman\libraries;

/**
 * Class Config
 * @package shaman\libraries
 */
class Config implements \shaman\interfaces\Config
{
    #region [protected properties]
    protected $path;
    protected $settings = [];
    #endregion

    #region [constructor]
    /**
     * Config constructor.
     *
     * @param string $path
     *
     * @throws \Exception
     */
    public function __construct(string $path = '')
    {
        $this->path = $path;
        $this->setSettings();
    }
    #endregion

    #region [public methods]
    /**
     * @return $this
     * @throws \Exception
     */
    public function setSettings()
    {
        if (!$this->path) {
            return $this;
        }

        if (!is_file($this->path)) {
            throw new \Exception('Incorrect path for config');
        }
        $settings = file_get_contents($this->path);
        if (!$settings) {
            throw new \Exception('Incorrect file config');
        }
        $settings = json_decode($settings, true);
        if (!$settings) {
            throw new \Exception('Config file has incorrect format');
        }
        $this->settings = $settings;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return string|array|null
     */
    public function getSetting(string $name)
    {
        return $this->settings[$name] ?? null;
    }

    /**
     * @return array
     */
    public function getSettings(): array
    {
        return $this->settings;
    }
    #endregion
}
