<?php
require_once __DIR__ . '/../vendor/autoload.php';

use WhoisApi\SimpleGeoip\Builders\ResponseModelBuilder;
use WhoisApi\SimpleGeoip\ApiClient;
use WhoisApi\SimpleGeoip\Clients\GuzzleClient;
use WhoisApi\SimpleGeoip\Exceptions\UnparsableResponseException;
use WhoisApi\SimpleGeoip\Exceptions\AccessDeniedException;
use WhoisApi\SimpleGeoip\Exceptions\ServerErrorException;
use WhoisApi\SimpleGeoip\Exceptions\EmptyResponseException;
use WhoisApi\SimpleGeoip\Exceptions\InvalidIpAddressException;


$httpClient = new GuzzleClient(new \GuzzleHttp\Client());
$builder = new ResponseModelBuilder('');
$client = new ApiClient($httpClient, $builder, getenv('API_KEY'));

try {
    $response = $client->get('1.1.1.1');
    echo 'IP: ' . $response->ip . PHP_EOL;
    echo 'Postal Code: ' . $response->location->postalCode . PHP_EOL;
    echo 'Timezone: ' . $response->location->timezone . PHP_EOL;
} catch (UnparsableResponseException $exception) {
    echo "Error: couldn't parse server response" . PHP_EOL;
} catch (EmptyResponseException $exception) {
    echo "Error: the response is empty" . PHP_EOL;
} catch (AccessDeniedException $exception) {
    echo "Error: ({$exception->getCode()}) {$exception->getMessage()}"
        . PHP_EOL;
} catch (ServerErrorException $exception) {
    echo "Error: ({$exception->getCode()}) {$exception->getMessage()}"
        . PHP_EOL;
} catch (InvalidIpAddressException $exception) {
    echo "Error: ({$exception->getCode()}) {$exception->getMessage()}"
        . PHP_EOL;
}