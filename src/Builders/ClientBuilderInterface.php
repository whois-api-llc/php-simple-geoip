<?php

namespace WhoisApi\SimpleGeoip\Builders;


/**
 * Interface ClientBuilderInterface
 * @package WhoisApi\SimpleGeoip\Builders
 */
interface ClientBuilderInterface
{
    /**
     * @param string $apiKey
     * @param string $url
     * @return \WhoisApi\SimpleGeoip\ApiClient
     */
    public function build($apiKey, $url = '');
}