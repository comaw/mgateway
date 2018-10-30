# GateWay version 0.1

DIRECTORY STRUCTURE
-------------------

```
src  /               work libraries
tests/               tests of libraries
```

REQUIREMENTS
------------

The minimum requirement is that your Web server supports PHP 7.1.

PARTICIPATE
-------------

To work with the library, create a configuration file as in the example

Connect the file to the main call Gateway. 
Further the library itself will redirect all requests 
with all parameters to the specified URL

```
include __DIR__ . '/vendor/autoload.php';
  
use shaman\Gateway;

$gateway = new Gateway(__DIR__ . '/example-settings.json');

$response = $gateway->send();


var_dump($response->getStatusCode());
var_dump($response->getBody()->getContents());
```

