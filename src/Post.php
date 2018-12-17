<?php

namespace Tistory;

use Tistory\Traits\Request;

/**
 * @method stdClass list($access_token, $options = [])
 * @method stdClass read($access_token, $options = [])
 * @method stdClass write($access_token, $options = [])
 * @method stdClass modify($access_token, $options = [])
 * @method stdClass attach($access_token, $options = [], $filename = null)
 */
class Post 
{
    use Request;

   /**
    * Getting posts list
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function list(string $access_token, array $options = []) 
    {
        return self::request('get', 'post/list', $access_token, $options);
    }

   /**
    * Reading a post
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function read(string $access_token, array $options = []) 
    {
        return self::request('get', 'post/read', $access_token, $options);
    }

   /**
    * Writing a post
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function write(string $access_token, array $options = []) 
    {
        return self::request('post', 'post/write', $access_token, $options);
    }

   /**
    * Modifying a post
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function modify(string $access_token, array $options = []) 
    {
        return self::request('post', 'post/modify', $access_token, $options);
    }

   /**
    * Attaching a file
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function attach(string $access_token, array $options = [], string $filename) 
    {
        return self::request('post', 'post/attach', $access_token, $options, $filename);
    }
}