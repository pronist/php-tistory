<?php

namespace Tistory\Traits;

use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

use Tistory\Exceptions\BadResponseException;
use Tistory\Exceptions\FileUploadException;

/**
 * @method stdClass get($url, $accessToken, $query = [])
 * @method stdClass post($url, $accessToken, $query = [])
 * @method stdClass request($method, $url, $accessToken, $query = [])
 */
trait Request
{
   /** 
    * @var string $httpClient GuzzleHttp Client
    */
    public static $httpClient;

   /**
    * Get Request
    *
    * @param string $url
    * @param string $accessToken
    * @param array $query
    *
    * @return stdClass
    */
    public static function get(
        string $url,
        string $accessToken,
        array $query = [])
    {
        try {
            $requestOptions = array_merge([
                'query' => [
                    'access_token' => $accessToken,
                    'output' => 'json'
                ]
            ], $query);
            $response = json_decode(
                Request::$httpClient->get(
                    $url, 
                    $requestOptions
                )->getBody(), true)
            ;
            return (object) $response['tistory']['item'];
        }
        catch (RequestException $e) {
            if ($e->hasResponse()) {
                throw new BadResponseException("Bad request", 400);
            }
        }
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
    public static function post(
        string $url,
        string $accessToken,
        array $query = [])
    {
        try {
            $requestOptions = [
                [
                    'name' => 'access_token',
                    'contents' => $accessToken
                ],
                [
                    'name' => 'output',
                    'contents' => 'json'
                ]
            ];
            foreach($query as $name => $contents) {
                array_push($requestOptions, [
                    'name' => $name,
                    'contents' => $contents
                ]);
            }
            $response = json_decode(
                Request::$httpClient->post($url, [
                    'multipart' => $requestOptions
                ]
                )->getBody(), true)
            ;
            $result = [];

            /** without 'status' */
            foreach($response['tistory'] as $key => $value) {
                if($key != 'status') {
                    $result[$key] = $value;
                }
            }
            return (object) $result;
        }
        catch (RequestException $e) {
            if ($e->hasResponse()) {
                throw new BadResponseException("Bad Request", 400);
            }
        }
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
    public static function request(
        string $method, 
        string $url,
        string $accessToken,
        array $query = [])
    {
        return Request::$method($url, $accessToken, $query);
    }
}

/**
 * Initialize GuzlleHttp\Client
 */
Request::$httpClient = new \GuzzleHttp\Client([
    'verify' => false,
    'base_uri' => 'https://www.tistory.com/apis/'
]);
