<?php

namespace WhoisApi\SimpleGeoip\Builders;

use WhoisApi\SimpleGeoip\Exceptions\UnparsableResponseException;
use WhoisApi\SimpleGeoip\Models\Location;
use WhoisApi\SimpleGeoip\Models\Response;

/**
 * Class ResponseModelBuilder
 * @package WhoisApi\SimpleGeoip\Builders
 */
class ResponseModelBuilder implements ResponseModelBuilderInterface
{
    /**
     * @var
     */
    protected $jsonData;

    /**
     * ResponseModelBuilder constructor.
     * @param $jsonData
     */
    public function __construct($jsonData)
    {
        $this->jsonData = $jsonData;
    }

    /**
     * @param string $jsonData
     * @return Response
     */
    public function build($jsonData = '')
    {
        if (strlen($jsonData) <= 0)
            $jsonData = $this->jsonData;

        $location = new Location();

        $responseModel = new Response(
            $this->parseJson($jsonData),
            $location
        );

        return $responseModel;
    }

    /**
     * @param $json
     * @return mixed
     * @throws UnparsableResponseException
     */
    protected function parseJson($json)
    {
        $parsed = json_decode($json, true);

        if (is_null($parsed) || $parsed === false) {
            throw new UnparsableResponseException();
        }

        return $parsed;
    }
}