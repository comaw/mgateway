<?php
/**
 * This is file for example base code!
 *
 * Created by PhpStorm.
 * User: shaman
 * Date: 10/29/18
 * Time: 4:07 PM
 */

include __DIR__ . '/vendor/autoload.php';

use shaman\Gateway;

$gateway = new Gateway(__DIR__ . '/example-settings.json');

$response = $gateway->send();


var_dump($response->getStatusCode());
var_dump($response->getBody()->getContents());
