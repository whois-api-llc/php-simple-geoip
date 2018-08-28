<?php

use PHPUnit\Framework\TestCase;
use WhoisApi\SimpleGeoip\ApiClient;
use WhoisApi\SimpleGeoip\Builders\ResponseModelBuilder;
use WhoisApi\SimpleGeoip\Clients\GuzzleClient;
use WhoisApi\SimpleGeoip\Exceptions\EmptyResponseException;


/**
 * Class ApiClientTest
 */
class ApiClientTest extends TestCase
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
    protected $url = 'https://geoipify.whoisxmlapi.com/api/v1337';

    /**
     *
     */
    public function testGetMethod()
    {
        /**
         * @var \WhoisApi\SimpleGeoip\Clients\ClientInterface|\PHPUnit\Framework\MockObject\MockObject $requestMock
         */
        $requestMock = $this->getMockBuilder(GuzzleClient::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $requestMock->expects($this->once())
            ->method('request')
            ->with(
                $this->equalTo('https://geoipify.whoisxmlapi.com/api/v1'),
                $this->equalTo('get'),
                $this->equalTo([
                    'apiKey' => 'at_testkey',
                    'outputFormat' => 'json',
                    'ipAddress' => '8.8.8.8'
                ]),
                $this->equalTo([
                    'User-Agent' => 'PHP Client library/1.0.0'
                ])
            )
            ->willReturn($this->sampleJson);

        $builder = new ResponseModelBuilder('');

        $builderValid = new ResponseModelBuilder($this->sampleJson);

        $client = new ApiClient($requestMock, $builder, $this->apiKey);

        $this->assertEquals($builderValid->build(), $client->get('8.8.8.8'));
    }

    /**
     *
     */
    public function testGetMethodEmptyResponse()
    {
        /**
         * @var \WhoisApi\SimpleGeoip\Clients\ClientInterface|\PHPUnit\Framework\MockObject\MockObject $requestMock
         */
        $requestMock = $this->getMockBuilder(GuzzleClient::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $requestMock->expects($this->once())
            ->method('request')
            ->with(
                $this->equalTo('https://geoipify.whoisxmlapi.com/api/v1'),
                $this->equalTo('get'),
                $this->equalTo([
                    'apiKey' => 'at_testkey',
                    'outputFormat' => 'json',
                    'ipAddress' => '8.8.8.8'
                ]),
                $this->equalTo([
                    'User-Agent' => 'PHP Client library/1.0.0'
                ])
            )
            ->willReturn('');

        $builder = new ResponseModelBuilder('');

        $client = new ApiClient($requestMock, $builder, $this->apiKey);

        $this->expectException(EmptyResponseException::class);

        $client->get('8.8.8.8');
    }

    /**
     *
     */
    public function testGetRawDataMethod()
    {
        /**
         * @var \WhoisApi\SimpleGeoip\Clients\ClientInterface|\PHPUnit\Framework\MockObject\MockObject $requestMock
         */
        $requestMock = $this->getMockBuilder(GuzzleClient::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $requestMock->expects($this->once())
            ->method('request')
            ->with(
                $this->equalTo('https://geoipify.whoisxmlapi.com/api/v1'),
                $this->equalTo('get'),
                $this->equalTo([
                    'apiKey' => 'at_testkey',
                    'outputFormat' => 'json',
                    'ipAddress' => '8.8.8.8'
                ]),
                $this->equalTo([
                    'User-Agent' => 'PHP Client library/1.0.0'
                ])
            )
            ->willReturn($this->sampleJson);

        $builder = new ResponseModelBuilder('');

        $client = new ApiClient($requestMock, $builder, $this->apiKey);

        $this->assertEquals(
            $this->sampleJson,
            $client->getRawData('8.8.8.8', 'json')
        );
    }

    /**
     *
     */
    public function testGetRawDataMethodEmptyResponse()
    {
        /**
         * @var \WhoisApi\SimpleGeoip\Clients\ClientInterface|\PHPUnit\Framework\MockObject\MockObject $requestMock
         */
        $requestMock = $this->getMockBuilder(GuzzleClient::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $requestMock->expects($this->once())
            ->method('request')
            ->with(
                $this->equalTo('https://geoipify.whoisxmlapi.com/api/v1'),
                $this->equalTo('get'),
                $this->equalTo([
                    'apiKey' => 'at_testkey',
                    'outputFormat' => 'json',
                    'ipAddress' => '8.8.8.8'
                ]),
                $this->equalTo([
                    'User-Agent' => 'PHP Client library/1.0.0'
                ])
            )
            ->willReturn('');

        $builder = new ResponseModelBuilder('');

        $client = new ApiClient($requestMock, $builder, $this->apiKey);

        $this->expectException(EmptyResponseException::class);

        $client->getRawData('8.8.8.8', 'json');
    }

    /**
     *
     */
    public function testApiClientCustomUrl()
    {
        /**
         * @var \WhoisApi\SimpleGeoip\Clients\ClientInterface|\PHPUnit\Framework\MockObject\MockObject $requestMock
         */
        $requestMock = $this->getMockBuilder(GuzzleClient::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $requestMock->expects($this->once())
            ->method('request')
            ->with(
                $this->equalTo('https://geoipify.whoisxmlapi.com/api/v1337'),
                $this->equalTo('get'),
                $this->equalTo([
                    'apiKey' => 'at_testkey',
                    'outputFormat' => 'json',
                    'ipAddress' => '8.8.8.8'
                ]),
                $this->equalTo([
                    'User-Agent' => 'PHP Client library/1.0.0'
                ])
            )
            ->willReturn($this->sampleJson);

        $builder = new ResponseModelBuilder('');

        $client = new ApiClient(
            $requestMock,
            $builder,
            $this->apiKey,
            $this->url
        );

        $this->assertEquals(
            $this->sampleJson,
            $client->getRawData('8.8.8.8', 'json')
        );
    }
}