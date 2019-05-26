<?php

namespace Pronist\Tistory;

use Tistory\Traits\Request;

/**
 * @method stdClass list($access_token, $options = [])
 */
class Category 
{
    use Request;

   /**
    * Getting Tistory category list
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */    
    public static function list(string $access_token, array $options = []) 
    {
        return self::request('get', 'category/list', $access_token, $options);
    }
}