<?php

namespace Pronist\Tistory;

use Pronist\Tistory\Traits\Request;

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
    public static function list(string $accessToken, array $options = [])
    {
        return self::request('get', 'category/list', $accessToken, $options);
    }
}
