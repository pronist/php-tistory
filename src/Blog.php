<?php

namespace Pronist\Tistory;

use Tistory\Traits\Request;

/**
 * @method stdClass info($access_token, $options = [])
 */
class Blog 
{
    use Request;
    
   /**
    * Getting Tistory blog info
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function info(string $access_token, array $options = []) 
    {
        return self::request('get', 'blog/info', $access_token, $options);
    }
}