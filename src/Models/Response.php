<?php

namespace WhoisApi\SimpleGeoip\Models;


/**
 * Class ResponseModel
 * @package WhoisApi\SimpleGeoip\Models
 */
class Response extends AbstractModel
{
    const LOCATION_KEY = 'location';

    /**
     * @var
     */
    public $ip;

    /**
     * @var Location
     */
    public $location;

    /**
     * Response constructor.
     * @param array $data
     * @param ModelInterface $location
     */
    public function __construct(
        array $data,
        ModelInterface $location
    )
    {
        $this->location = $location;

        if (count($data) > 0)
            $this->parse($data);
    }

    /**
     * @param array $data
     */
    protected function parseAssocArray(array $data)
    {
        if (isset($data[static::LOCATION_KEY]))
            $this->location->parse($data[static::LOCATION_KEY]);

        parent::parseAssocArray($data);
    }
}