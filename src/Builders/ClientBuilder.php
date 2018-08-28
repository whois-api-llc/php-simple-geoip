<?php

namespace WhoisApi\SimpleGeoip\Builders;


use GuzzleHttp\Client;
use WhoisApi\SimpleGeoip\ApiClient;
use WhoisApi\SimpleGeoip\Clients\GuzzleClient;

/**
 * Class ClientBuilder
 * @package WhoisApi\SimpleGeoip\Builders
 */
class ClientBuilder implements ClientBuilderInterface
{

    /**
     * @param string $apiKey
     * @param string $url
     * @return ApiClient
     */
    public function build($apiKey, $url = '')
    {
        $builder = new ResponseModelBuilder('');
        $client = new GuzzleClient(new Client());

        return new ApiClient($client, $builder, $apiKey, $url);
    }
}