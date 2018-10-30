<?php
/**
 * Created by PhpStorm.
 * User: shaman
 * Date: 10/30/18
 * Time: 9:08 AM
 */

namespace shaman\interfaces;

/**
 * Interface Config
 * @package shaman\interfaces
 */
interface Config
{
    /**
     * Get one setting by name
     *
     * @param string $name
     *
     * @return string|array|null
     */
    public function getSetting(string $name);

    /**
     * Get all settings
     *
     * @return array
     */
    public function getSettings(): array;
}
