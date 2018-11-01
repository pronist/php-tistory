<?php

namespace Tistory\Exceptions;

/**
 * Exception for Tistory API 4xx, 5xx
 */
class BadResponseException extends \Exception 
{
    public function __construct(
        $message, 
        $code = 0, 
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}