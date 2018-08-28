<?php
require_once __DIR__ . '/../vendor/autoload.php';

use WhoisApi\SimpleGeoip\Builders\ClientBuilder;


$builder = new ClientBuilder();

$client = $builder->build(getenv('API_KEY'));

echo $client->getRawData('8.8.8.8') . PHP_EOL;

echo print_r($client->get('8.8.8.8'), 1) . PHP_EOL;