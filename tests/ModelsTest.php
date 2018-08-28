<?php

use PHPUnit\Framework\TestCase;
use WhoisApi\SimpleGeoip\Models\Location;
use WhoisApi\SimpleGeoip\Models\Response;


/**
 * Class ModelsTest
 */
class ModelsTest extends TestCase
{

    /**
     * @var string
     */
    protected $sampleJson = <<<EOT
{
  "ip":"8.8.8.8",
  "location": {
    "country": "US",
    "region": "California",
    "city": "Mountain View",
    "lat": "37.40599",
    "lng": "-122.078514",
    "postalCode": "94043",
    "timezone": "-08:00"
  }
}
EOT;

    /**
     * @var array
     */
    protected $sampleData = [];

    /**
     * @var
     */
    protected $sampleLocationModel;

    /**
     * @var
     */
    protected $sampleResponseModel;

    /**
     *
     */
    public function setUp()
    {
        $this->sampleData = json_decode($this->sampleJson, true);

        $locationModel = new Location();
        $locationModel->city = 'Mountain View';
        $locationModel->region = 'California';
        $locationModel->country = 'US';
        $locationModel->lat = '37.40599';
        $locationModel->lng = '-122.078514';
        $locationModel->postalCode = '94043';
        $locationModel->timezone = '-08:00';

        $this->sampleLocationModel = $locationModel;

        $responseModel = new Response(
            [],
            $this->sampleLocationModel
        );

        $this->sampleResponseModel = $responseModel;
        $this->sampleResponseModel->ip = '8.8.8.8';
    }

    /**
     *
     */
    public function testLocationModel()
    {
        $model = new Location();

        $model->parse($this->sampleData['location']);

        $this->assertEquals($this->sampleLocationModel, $model);
    }

    /**
     *
     */
    public function testResponseModel()
    {
        $model = new Response(
            $this->sampleData,
            new Location()
        );

        $this->assertEquals($this->sampleResponseModel, $model);
    }
}