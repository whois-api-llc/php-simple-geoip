<?php

namespace WhoisApi\SimpleGeoip\Clients;

use GuzzleHttp\ClientInterface as GuzzleInterface;
use WhoisApi\SimpleGeoip\Exceptions\AccessDeniedException;
use WhoisApi\SimpleGeoip\Exceptions\InvalidIpAddressException;
use WhoisApi\SimpleGeoip\Exceptions\ServerErrorException;

/**
 * Class GuzzleClient
 * @package WhoisApi\SimpleGeoip\Clients
 */
class GuzzleClient implements ClientInterface
{
    const DEPRECATED_HEADER_KEY = 'Warning';

    /**
     * @var array
     */
    protected $errorExceptionsMapping = [
        400 => InvalidIpAddressException::class,
        403 => AccessDeniedException::class,
    ];

    /**
     * @var GuzzleInterface
     */
    protected $client;

    /**
     * GuzzleClient constructor.
     * @param GuzzleInterface $client
     */
    public function __construct(
        GuzzleInterface $client
    )
    {
        $this->client = $client;
    }

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
    public function request($url, $method, array $payload, array $headers)
    {
        $payloadKey = (strtolower($method) === 'get') ? 'query' : 'body';

        $headers = $headers + ['Connection' => 'close'];

        $response = $this->client->request(
            strtoupper($method),
            $url,
            [
                $payloadKey => $payload,
                'headers' => $headers,
                'http_errors' => false,
            ]
        );

        $code = $response->getStatusCode();

        if (in_array($code, array_keys($this->errorExceptionsMapping)))
            throw new $this->errorExceptionsMapping[$code]();

        if ($code < 200 || $code >= 300) {
            throw new ServerErrorException(
                $response->getReasonPhrase(),
                $response->getStatusCode()
            );
        }

        $stringBody = (string)$response->getBody();

        $response->getBody()->close();

        return $stringBody;
    }
}