<?php

namespace WhoisApi\SimpleGeoip\Exceptions;

use Throwable;


/**
 * Class InvalidIpAddressException
 * @package WhoisApi\SimpleGeoip\Exceptions
 */
class InvalidIpAddressException extends \Exception
{
    /**
     * InvalidIpAddressException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if ($message === "")
            $message = 'Invalid IP address';
        if ($code === 0)
            $code = 400;

        parent::__construct($message, $code, $previous);
    }
}