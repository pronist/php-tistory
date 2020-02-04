<?php

namespace Pronist\Tistory\Traits;

use GuzzleHttp\Psr7;

trait Request
{
   /**
    * @var string $httpClient GuzzleHttp Client
    */
    private static $httpClient;

   /**
    * Get Request
    *
    * @param string $url
    * @param string $accessToken
    * @param array $query
    *
    * @return stdClass
    */
    private function get(string $url, string $accessToken, array $query = [])
    {
        return (string) self::$httpClient->get(
            $url,
            [
                'query' => array_merge($query, [
                    'access_token'  => $accessToken,
                ])
            ]
        )->getBody();
    }

   /**
    * Post Request
    *
    * @param string $url
    * @param string $accessToken
    * @param array $query
    *
    * @return stdClass
    */
    private static function post(string $url, string $accessToken, array $query = [])
    {
        $requestOptions = [];

        $query['access_token'] = $accessToken;

        foreach ($query as $name => $contents) {
            array_push($requestOptions, [
                'name'      => $name,
                'contents'  => $contents
            ]);
        }

        return (string) self::$httpClient->post(
            $url,
            [
                'multipart' => $requestOptions
            ]
        )->getBody();
    }

   /**
    * Tistory API Request
    *
    * @param string $method
    * @param string $url
    * @param string $accessToken
    * @param array $query
    *
    * @return stdClass
    */
    private static function request(string $method, string $url, string $accessToken, array $query = [])
    {
        if (empty(self::$httpClient)) {
            /**
             * Initialize GuzlleHttp\Client
             */
            self::$httpClient = new \GuzzleHttp\Client([
                'verify' => false,
                'base_uri' => 'https://www.tistory.com/apis/'
            ]);
        }

        return self::$method($url, $accessToken, $query);
    }
}
