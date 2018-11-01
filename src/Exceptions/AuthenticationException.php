<?php

namespace Tistory\Exceptions;

/**
 * Exception for OAuth2 authentication
 * 
 * @method string getDescription()
 */
class AuthenticationException extends \Exception 
{
   /** 
    * @var string $description OAuth2 error_description
    */
    protected $description;

    public function __construct(
        $error,
        $description,
        $code = 0, 
        \Exception $previous = null
    ) {
        parent::__construct($error, $code, $previous);

        $this->description = $description;
    }

   /**
    * getting OAuth2 error description
    *
    * @return string
    */
    public function getDescription()
    {
        return $this->description;
    }
}