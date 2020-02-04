<?php

namespace Pronist\Tistory;

use Pronist\Tistory\Traits\Request;

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
    public static function newest(string $accessToken, array $options = [])
    {
        return self::request('get', 'comment/newest', $accessToken, $options);
    }

    /**
     * Getting comments list
     *
     * @param string $accessToken
     * @param array $options
     *
     * @return stdClass
     */
    public static function list(string $accessToken, array $options = [])
    {
        return self::request('get', 'comment/list', $accessToken, $options);
    }

    /**
     * Writing a comment
     *
     * @param string $accessToken
     * @param array $options
     *
     * @return stdClass
     */
    public static function write(string $accessToken, array $options = [])
    {
        return self::request('post', 'comment/write', $accessToken, $options);
    }

    /**
     * Modifying a comment
     *
     * @param string $accessToken
     * @param array $options
     *
     * @return stdClass
     */
    public static function modify(string $accessToken, array $options = [])
    {
        return self::request('post', 'comment/modify', $accessToken, $options);
    }

    /**
     * Deleting a comment
     *
     * @param string $accessToken
     * @param array $options
     *
     * @return stdClass
     */
    public static function delete(string $accessToken, array $options = [])
    {
        return self::request('post', 'comment/delete', $accessToken, $options);
    }
}
