<?php

namespace WhoisApi\SimpleGeoip\Models;


/**
 * Interface ModelInterface
 * @package WhoisApi\SimpleGeoip\Models
 */
interface ModelInterface
{
    /**
     * @param array $data
     */
    public function parse(array $data);
}