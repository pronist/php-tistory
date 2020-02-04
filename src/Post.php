<?php

namespace Pronist\Tistory;

use Pronist\Tistory\Traits\Request;

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
    public static function list(string $accessToken, array $options = [])
    {
        return self::request('get', 'post/list', $accessToken, $options);
    }

   /**
    * Reading a post
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function read(string $accessToken, array $options = [])
    {
        return self::request('get', 'post/read', $accessToken, $options);
    }

   /**
    * Writing a post
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function write(string $accessToken, array $options = [])
    {
        return self::request('post', 'post/write', $accessToken, $options);
    }

   /**
    * Modifying a post
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function modify(string $accessToken, array $options = [])
    {
        return self::request('post', 'post/modify', $accessToken, $options);
    }

   /**
    * Attaching a file
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function attach(string $accessToken, array $options = [])
    {
        return self::request('post', 'post/attach', $accessToken, $options);
    }
}
