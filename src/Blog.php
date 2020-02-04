<?php

namespace Pronist\Tistory;

use Pronist\Tistory\Traits\Request;

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
    public static function info(string $accessToken, array $options = [])
    {
        return self::request('get', 'blog/info', $accessToken, $options);
    }
}
