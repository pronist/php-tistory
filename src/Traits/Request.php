<?php

namespace Tistory\Traits;

use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

use Tistory\Exceptions\BadResponseException;
use Tistory\Exceptions\FileUploadException;

/**
 * @method stdClass getOptions($accessToken, $query = [], $filename = null)
 * @method stdClass get($url, $accessToken, $query = [])
 * @method stdClass post($url, $accessToken, $query = [], $filename = null)
 * @method stdClass request($method, $url, $accessToken, $query = [], $filename = null)
 */
trait Request
{
   /** 
    * @var string $httpClient GuzzleHttp Client
    */
    public static $httpClient;

   /**
    * Getting request options
    *
    * @param string $accessToken
    * @param array $query
    * @param string $filename
    *
    * @return array
    */
    public static function getOptions(
        string $accessToken, 
        array $query = [], 
        string $filename = null)
    {
        $requestOptions = [
            'query' => array_merge([
                'access_token' => $accessToken,
                'output' => 'json',
            ], $query)
        ];
        if($filename) {
            /** file upload? */
            $requestOptions = array_merge($requestOptions, [
                'multipart' => [
                    [
                        'name' => 'uploadedfile',
                        'contents' => fopen($filename, 'r')
                    ]
                ]
            ]);
        }
        return $requestOptions;
    }

   /**
    * Get
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
            $response = json_decode(
                Request::$httpClient->get(
                    $url, 
                    Request::getOptions($accessToken, $query)
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
    * Post
    *
    * @param string $url
    * @param string $accessToken
    * @param array $query
    * @param string $filename
    *
    * @return stdClass
    */
    public static function post(
        string $url,
        string $accessToken,
        array $query = [],
        string $filename = null)
    {
        try {
            $response = json_decode(
                Request::$httpClient->post(
                    $url, 
                    Request::getOptions($accessToken, $query, $filename)
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
                if($filename) {
                    throw new FileUploadException("The file ${filename} upload failed.", 400);
                }
                else {
                    throw new BadResponseException("Bad request", 400);
                }
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
    * @param string $filename
    *
    * @return stdClass
    */
    public static function request(
        string $method, 
        string $url,
        string $accessToken,
        array $query = [],
        string $filename = null)
    {
        return Request::$method($url, $accessToken, $query, $filename);
    }
}

/**
 * Initialize GuzlleHttp\Client
 */
Request::$httpClient = new \GuzzleHttp\Client([
    'verify' => false,
    'base_uri' => 'https://www.tistory.com/apis/'
]);
