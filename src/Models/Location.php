<?php


namespace WhoisApi\SimpleGeoip\Models;


/**
 * Class Location
 * @package WhoisApi\SimpleGeoip\Models
 */
class Location extends AbstractModel
{
    /**
     * @var
     */
    public $country;

    /**
     * @var
     */
    public $region;

    /**
     * @var
     */
    public $city;

    /**
     * @var
     */
    public $lat;

    /**
     * @var
     */
    public $lng;

    /**
     * @var
     */
    public $postalCode;

    /**
     * @var
     */
    public $timezone;
}