# php-simple-geoip

*The simplest possible way to get IP geolocation information in PHP.*

## Prerequisites

To use this library, you'll need to create a free GeoIPify account:
https://geoipify.whoisxmlapi.com/

If you haven't done this yet, please do so now.


## Installation

To install `simple-geoip` using [composer](https://getcomposer.org/), simply run:

```console
$ composer require whois-api/simple-geoip
```
In the root of your project directory.


To use the library, use Composer's [autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading)

```php
require_once __DIR__ . "/vendor/autoload.php";
```

## Requirements

### Supported PHP versions:

* PHP 5.6.x
* PHP 7.0.x
* PHP 7.1.x
* PHP 7.2.x

### Dependencies:

* mbstring
* mbregex
* json
* curl

## Documentation

Full API documentation available [here](https://geoipify.whoisxmlapi.com/docs)

## Usage

Once you have `simple-geoip` installed, you can use it to easily find the
physical location of a given IP address.

This library gives you access to all sorts of geographical location data that
you can use in your application in any number of ways.

```php
<?php
require_once  __DIR__ . '/../vendor/autoload.php';

use WhoisApi\SimpleGeoip\Builders\ClientBuilder;


$builder = new ClientBuilder();

$client = $builder->build('your API_KEY');

try {
    echo $client->getRawData('8.8.8.8', 'json') . PHP_EOL;
    echo print_r($client->get('8.8.8.8'), 1) . PHP_EOL;
    
    $result = $client->get('1.1.1.1');
    echo 'IP: ' . $result->ip . PHP_EOL;
    echo 'Country: ' . $result->location->country . PHP_EOL;
    echo 'Region: ' . $result->location->region . PHP_EOL;
    echo 'City: ' . $result->location->city . PHP_EOL;
    echo 'Latitude: ' . $result->location->lat . PHP_EOL;
    echo 'Longitude: ' . $result->location->lng . PHP_EOL;
    echo 'Postal Code: ' . $result->location->postalCode . PHP_EOL;
    echo 'Timezone: ' . $result->location->timezone . PHP_EOL;
} catch (\Throwable $exception) {
    echo "Error: {$exception->getCode()} {$exception->getMessage()}" . PHP_EOL;
}
```
More examples you can see in the "examples" directory. 

Here's the sort of data you might get back when performing a geoip lookup
request:

```json
{
  "ip": "8.8.8.8",
  "location": {
    "country": "US",
    "region": "California",
    "city": "Mountain View",
    "lat": 37.40599,
    "lng": -122.078514,
    "postalCode": "94043",
    "timezone": "-08:00"
  }
}
```

## Development

After you clone this repository you need to install all requirements:

```console
$ composer install
```

To run tests you can use the following command

```console
$ composer run-script test
```