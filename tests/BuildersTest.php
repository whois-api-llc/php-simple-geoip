<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use WhoisApi\SimpleGeoip\ApiClient;
use WhoisApi\SimpleGeoip\Builders\ClientBuilder;
use WhoisApi\SimpleGeoip\Builders\ResponseModelBuilder;
use WhoisApi\SimpleGeoip\Clients\GuzzleClient;
use WhoisApi\SimpleGeoip\Exceptions\UnparsableResponseException;
use WhoisApi\SimpleGeoip\Models\Location;
use WhoisApi\SimpleGeoip\Models\Response;


/**
 * Class BuilderTest
 */
class BuilderTest extends TestCase
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
     * @var string
     */
    protected $apiKey = 'at_testkey';


    /**
     * @var string
     */
    protected $url = 'https://geoipify.whoisxmlapi.com/api/v1';


    /**
     *
     */
    public function testParsing()
    {
        $location = new Location();

        $responseModel = new Response(
            json_decode($this->sampleJson, true),
            $location
        );

        $builder = new ResponseModelBuilder('');

        $this->assertEquals($responseModel, $builder->build($this->sampleJson));
    }

    /**
     *
     */
    public function testParsingFailure()
    {
        $builder = new ResponseModelBuilder('');

        $this->expectException(UnparsableResponseException::class);

        $builder->build('smth good');
    }

    /**
     *
     */
    public function testClientBuilder()
    {
        $builder = new ResponseModelBuilder('');
        $client = new GuzzleClient(new Client());

        $valid = new ApiClient($client, $builder, $this->apiKey, $this->url);

        $clientBuilder = new ClientBuilder();

        $test = $clientBuilder->build($this->apiKey, $this->url);

        $this->assertEquals($valid, $test);
    }
}