<?php

use PHPUnit\Framework\TestCase;
use WhoisApi\SimpleGeoip\Clients\GuzzleClient;
use WhoisApi\SimpleGeoip\Exceptions\AccessDeniedException;
use WhoisApi\SimpleGeoip\Exceptions\InvalidIpAddressException;
use WhoisApi\SimpleGeoip\Exceptions\ServerErrorException;


/**
 * Class RequestTest
 */
class RequestTest extends TestCase
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
     *
     */
    public function testRequest200Code()
    {
        $stream = $this->getMockBuilder(\GuzzleHttp\Psr7\Stream::class)
            ->disableOriginalConstructor()
            ->setMethods(['close', '__toString'])
            ->getMock();

        $stream->method('close')
            ->willReturn('');
        $stream->method('__toString')
            ->willReturn($this->sampleJson);

        $response = $this->getMockBuilder(\GuzzleHttp\Psr7\Response::class)
            ->disableOriginalConstructor()
            ->setMethods(['getStatusCode', 'getReasonPhrase', 'getBody', 'hasHeader', 'getHeader'])
            ->getMock();

        $response->method('getStatusCode')
            ->willReturn(200);
        $response->method('getReasonPhrase')
            ->willReturn('OK');
        $response->method('getBody')
            ->willReturn($stream);
        $response->method('hasHeader')
            ->willReturn(false);
        $response->method('getHeader')
            ->willReturn('');

        /**
         * @var GuzzleHttp\ClientInterface|\PHPUnit\Framework\MockObject\MockObject $request
         */
        $request = $this->getMockBuilder(\GuzzleHttp\Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $request->method('request')
            ->willReturn($response);

        $client = new GuzzleClient($request);

        $this->assertEquals(
            $this->sampleJson,
            $client->request('https://test.test', 'get', [], [])
        );
    }

    /**
     *
     */
    public function testRequest199Code()
    {
        $response = $this->getMockBuilder(\GuzzleHttp\Psr7\Response::class)
            ->disableOriginalConstructor()
            ->setMethods(['getStatusCode', 'getReasonPhrase', 'getBody', 'hasHeader', 'getHeader'])
            ->getMock();

        $response->method('getStatusCode')
            ->willReturn(199);
        $response->method('getReasonPhrase')
            ->willReturn('');
        $response->method('getBody')
            ->willReturn($this->sampleJson);
        $response->method('hasHeader')
            ->willReturn(false);
        $response->method('getHeader')
            ->willReturn('');

        /**
         * @var GuzzleHttp\ClientInterface|\PHPUnit\Framework\MockObject\MockObject $request
         */
        $request = $this->getMockBuilder(\GuzzleHttp\Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $request->method('request')
            ->willReturn($response);

        $client = new GuzzleClient($request);

        $this->expectException(ServerErrorException::class);
        $client->request('', '', [], []);
    }

    /**
     *
     */
    public function testRequest300Code()
    {
        $response = $this->getMockBuilder(\GuzzleHttp\Psr7\Response::class)
            ->disableOriginalConstructor()
            ->setMethods(['getStatusCode', 'getReasonPhrase', 'getBody', 'hasHeader', 'getHeader'])
            ->getMock();

        $response->method('getStatusCode')
            ->willReturn(300);
        $response->method('getReasonPhrase')
            ->willReturn('');
        $response->method('getBody')
            ->willReturn($this->sampleJson);
        $response->method('hasHeader')
            ->willReturn(false);
        $response->method('getHeader')
            ->willReturn('');

        /**
         * @var GuzzleHttp\ClientInterface|\PHPUnit\Framework\MockObject\MockObject $request
         */
        $request = $this->getMockBuilder(\GuzzleHttp\Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $request->method('request')
            ->willReturn($response);

        $client = new GuzzleClient($request);

        $this->expectException(ServerErrorException::class);
        $client->request('', '', [], []);
    }

    /**
     *
     */
    public function testRequest404Code()
    {
        $response = $this->getMockBuilder(\GuzzleHttp\Psr7\Response::class)
            ->disableOriginalConstructor()
            ->setMethods(['getStatusCode', 'getReasonPhrase', 'getBody', 'hasHeader', 'getHeader'])
            ->getMock();

        $response->method('getStatusCode')
            ->willReturn(404);
        $response->method('getReasonPhrase')
            ->willReturn('');
        $response->method('getBody')
            ->willReturn($this->sampleJson);
        $response->method('hasHeader')
            ->willReturn(false);
        $response->method('getHeader')
            ->willReturn('');

        /**
         * @var GuzzleHttp\ClientInterface|\PHPUnit\Framework\MockObject\MockObject $request
         */
        $request = $this->getMockBuilder(\GuzzleHttp\Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $request->method('request')
            ->willReturn($response);

        $client = new GuzzleClient($request);

        $this->expectException(ServerErrorException::class);
        $client->request('', '', [], []);
    }

    /**
     *
     */
    public function testRequest500Code()
    {
        $response = $this->getMockBuilder(\GuzzleHttp\Psr7\Response::class)
            ->disableOriginalConstructor()
            ->setMethods(['getStatusCode', 'getReasonPhrase', 'getBody', 'hasHeader', 'getHeader'])
            ->getMock();

        $response->method('getStatusCode')
            ->willReturn(500);
        $response->method('getReasonPhrase')
            ->willReturn('');
        $response->method('getBody')
            ->willReturn($this->sampleJson);
        $response->method('hasHeader')
            ->willReturn(false);
        $response->method('getHeader')
            ->willReturn('');

        /**
         * @var GuzzleHttp\ClientInterface|\PHPUnit\Framework\MockObject\MockObject $request
         */
        $request = $this->getMockBuilder(\GuzzleHttp\Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $request->method('request')
            ->willReturn($response);

        $client = new GuzzleClient($request);

        $this->expectException(ServerErrorException::class);
        $client->request('', '', [], []);
    }

    /**
     *
     */
    public function testRequest400Code()
    {
        $response = $this->getMockBuilder(\GuzzleHttp\Psr7\Response::class)
            ->disableOriginalConstructor()
            ->setMethods(['getStatusCode', 'getReasonPhrase', 'getBody', 'hasHeader', 'getHeader'])
            ->getMock();

        $response->method('getStatusCode')
            ->willReturn(400);
        $response->method('getReasonPhrase')
            ->willReturn('');
        $response->method('getBody')
            ->willReturn($this->sampleJson);
        $response->method('hasHeader')
            ->willReturn(false);
        $response->method('getHeader')
            ->willReturn('');

        /**
         * @var GuzzleHttp\ClientInterface|\PHPUnit\Framework\MockObject\MockObject $request
         */
        $request = $this->getMockBuilder(\GuzzleHttp\Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $request->method('request')
            ->willReturn($response);

        $client = new GuzzleClient($request);

        $this->expectException(InvalidIpAddressException::class);
        $client->request('', '', [], []);
    }

    /**
     *
     */
    public function testRequest403Code()
    {
        $response = $this->getMockBuilder(\GuzzleHttp\Psr7\Response::class)
            ->disableOriginalConstructor()
            ->setMethods(['getStatusCode', 'getReasonPhrase', 'getBody', 'hasHeader', 'getHeader'])
            ->getMock();

        $response->method('getStatusCode')
            ->willReturn(403);
        $response->method('getReasonPhrase')
            ->willReturn('');
        $response->method('getBody')
            ->willReturn($this->sampleJson);
        $response->method('hasHeader')
            ->willReturn(false);
        $response->method('getHeader')
            ->willReturn('');

        /**
         * @var GuzzleHttp\ClientInterface|\PHPUnit\Framework\MockObject\MockObject $request
         */
        $request = $this->getMockBuilder(\GuzzleHttp\Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $request->method('request')
            ->willReturn($response);

        $client = new GuzzleClient($request);

        $this->expectException(AccessDeniedException::class);
        $client->request('', '', [], []);
    }
}