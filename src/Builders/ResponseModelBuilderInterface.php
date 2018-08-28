<?php


namespace WhoisApi\SimpleGeoip\Builders;


/**
 * Interface ResponseModelBuilderInterface
 * @package WhoisApi\SimpleGeoip\Builders
 */
interface ResponseModelBuilderInterface
{
    /**
     * @param string $jsonData
     * @return \WhoisApi\SimpleGeoip\Models\Response
     * @throws \WhoisApi\SimpleGeoip\Exceptions\UnparsableResponseException
     */
    public function build($jsonData = '');
}