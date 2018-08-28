<?php
require_once __DIR__ . '/../vendor/autoload.php';

use WhoisApi\SimpleGeoip\Builders\ClientBuilder;


$builder = new ClientBuilder();

$client = $builder->build(getenv('API_KEY'));

echo $client->getRawData('1.1.1.1', 'xml');