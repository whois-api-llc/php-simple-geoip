<?php

namespace WhoisApi\SimpleGeoip;

use WhoisApi\SimpleGeoip\Exceptions\AccessDeniedException;
use WhoisApi\SimpleGeoip\Exceptions\EmptyResponseException;
use WhoisApi\SimpleGeoip\Exceptions\InvalidIpAddressException;
use WhoisApi\SimpleGeoip\Exceptions\ServerErrorException;
use WhoisApi\SimpleGeoip\Exceptions\UnparsableResponseException;

/**
 * Interface ApiClientInterface
 */
interface ApiClientInterface
{
    /**
     * @param string $url Base API URl
     */
    public function setBaseUrl($url);

    /**
     * @param string $apiKey Your API key
     */
    public function setApiKey($apiKey);

    /**
     * @param string $ip
     * @return \WhoisApi\SimpleGeoip\Models\Response
     * @throws EmptyResponseException
     * @throws ServerErrorException
     * @throws AccessDeniedException
     * @throws InvalidIpAddressException
     * @throws UnparsableResponseException
     */
    public function get($ip);

    /**
     * @param string $ip
     * @param string $format Supported formats json/xml
     * @return string
     * @throws EmptyResponseException
     * @throws ServerErrorException
     * @throws AccessDeniedException
     * @throws InvalidIpAddressException
     * @throws UnparsableResponseException
     */
    public function getRawData($ip, $format = null);
}