<?php

namespace WhoisApi\SimpleGeoip\Clients;

use WhoisApi\SimpleGeoip\Exceptions\AccessDeniedException;
use WhoisApi\SimpleGeoip\Exceptions\InvalidIpAddressException;
use WhoisApi\SimpleGeoip\Exceptions\ServerErrorException;


/**
 * Interface ClientInterface
 * @package WhoisApi\SimpleGeoip\Clients
 */
interface ClientInterface
{
    /**
     * @param $url
     * @param $method
     * @param array $payload
     * @param array $headers
     * @return string
     * @throws ServerErrorException
     * @throws AccessDeniedException
     * @throws InvalidIpAddressException
     */
    public function request($url, $method, array $payload, array $headers);
}