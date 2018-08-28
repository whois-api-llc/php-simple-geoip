<?php

namespace WhoisApi\SimpleGeoip\Models;


/**
 * Class AbstractModel
 * @package WhoisApi\SimpleGeoip\Models
 */
abstract class AbstractModel implements ModelInterface
{
    /**
     * @param array $data
     */
    public function parse(array $data)
    {
        $this->parseAssocArray($data);
    }

    /**
     * @param array $data
     */
    protected function parseAssocArray(array $data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value))
                continue;

            if (property_exists($this, $key))
                $this->{$key} = $value;
        }
    }

}