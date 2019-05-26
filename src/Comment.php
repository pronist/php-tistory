<?php

namespace Pronist\Tistory;

use Tistory\Traits\Request;

/**
 * @method stdClass newest($access_token, $options = [])
 * @method stdClass list($access_token, $options = [])
 * @method stdClass write($access_token, $options = [])
 * @method stdClass modify($access_token, $options = [])
 * @method stdClass delete($access_token, $options = [])
 */
class Comment 
{
    use Request;

   /**
    * Getting newest comments
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function newest(string $access_token, array $options = []) 
    {
        return self::request('get', 'comment/newest', $access_token, $options);
    }

   /**
    * Getting comments list
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function list(string $access_token, array $options = []) 
    {
        return self::request('get', 'comment/list', $access_token, $options);
    }

   /**
    * Writing a comment
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function write(string $access_token, array $options = []) 
    {
        return self::request('post', 'comment/write', $access_token, $options);
    }

   /**
    * Modifying a comment
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function modify(string $access_token, array $options = []) 
    {
        return self::request('post', 'comment/modify', $access_token, $options);
    }

   /**
    * Deleting a comment
    *
    * @param string $accessToken
    * @param array $options
    *
    * @return stdClass
    */
    public static function delete(string $access_token, array $options = []) 
    {
        return self::request('post', 'comment/delete', $access_token, $options);
    }
}