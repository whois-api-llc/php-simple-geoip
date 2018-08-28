<?php

namespace WhoisApi\SimpleGeoip;

use WhoisApi\SimpleGeoip\Builders\ResponseModelBuilderInterface;
use WhoisApi\SimpleGeoip\Clients\ClientInterface;
use WhoisApi\SimpleGeoip\Exceptions\AccessDeniedException;
use WhoisApi\SimpleGeoip\Exceptions\EmptyResponseException;
use WhoisApi\SimpleGeoip\Exceptions\InvalidIpAddressException;
use WhoisApi\SimpleGeoip\Exceptions\ServerErrorException;
use WhoisApi\SimpleGeoip\Exceptions\UnparsableResponseException;


/**
 * Class ApiClient
 * @package WhoisApi\SimpleGeoip
 */
class ApiClient implements ApiClientInterface
{
    const API_BASE_URL = 'https://geoipify.whoisxmlapi.com/api/v1';
    const USER_AGENT_BASE = 'PHP Client library/';
    const VERSION = '1.0.0';

    const API_KEY_F = 'apiKey';
    const IP_ADDRESS_F = 'ipAddress';
    const FORMAT_F = 'outputFormat';

    const DEFAULT_FORMAT_V = 'json';

    const REQUEST_METHOD = 'get';

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var ResponseModelBuilderInterface
     */
    protected $builder;

    /**
     * @var
     */
    protected $url;

    /**
     * @var
     */
    protected $apiKey;

    /**
     * ApiClient constructor.
     * @param ClientInterface $client
     * @param ResponseModelBuilderInterface $builder
     * @param $apiKey
     * @param string $url
     */
    public function __construct(
        ClientInterface $client,
        ResponseModelBuilderInterface $builder,
        $apiKey,
        $url = ""
    )
    {
        $this->client = $client;
        $this->builder = $builder;
        $this->setApiKey($apiKey);

        if ($url === "") {
            $this->setBaseUrl(static::API_BASE_URL);
        } else {
            $this->setBaseUrl($url);
        }
    }

    /**
     * @param string ip
     * @return Models\Response
     * @throws EmptyResponseException
     * @throws ServerErrorException
     * @throws AccessDeniedException
     * @throws InvalidIpAddressException
     * @throws UnparsableResponseException
     */
    public function get($ip)
    {
        $payload = [
            static::API_KEY_F => $this->apiKey,
            static::IP_ADDRESS_F => $ip,
            static::FORMAT_F => static::DEFAULT_FORMAT_V,
        ];

        $response = $this->client->request(
            $this->url,
            static::REQUEST_METHOD,
            $payload,
            $this->buildCustomHeaders()
        );

        if (strlen($response) <= 0) {
            throw new EmptyResponseException();
        }

        return $this->builder->build($response);
    }

    /**
     * @param $ip
     * @param string $format
     * @return string
     * @throws EmptyResponseException
     * @throws ServerErrorException
     * @throws AccessDeniedException
     * @throws InvalidIpAddressException
     * @throws UnparsableResponseException
     */
    public function getRawData($ip, $format = null)
    {
        $format = is_null($format) ? static::DEFAULT_FORMAT_V : $format;
        $payload = [
            static::API_KEY_F => $this->apiKey,
            static::IP_ADDRESS_F => $ip,
            static::FORMAT_F => $format,
        ];

        $response = $this->client->request(
            $this->url,
            static::REQUEST_METHOD,
            $payload,
            $this->buildCustomHeaders()
        );

        if (strlen($response) <= 0) {
            throw new EmptyResponseException();
        }

        return $response;
    }

    /**
     * @param $apiKey
     */
    public function setApiKey($apiKey)
    {
        if (!empty($apiKey) && is_string($apiKey))
            $this->apiKey = $apiKey;
    }

    /**
     * @param $url
     */
    public function setBaseUrl($url)
    {
        if (!empty($url) && is_string($url))
            $this->url = $url;
    }

    /**
     * @return array
     */
    protected function buildCustomHeaders()
    {
        return [
            'User-Agent' => static::USER_AGENT_BASE . static::VERSION,
        ];
    }
}