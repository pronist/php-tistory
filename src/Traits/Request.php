<?php

namespace Tistory\Traits;

use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

use Tistory\Exceptions\BadResponseException;
use Tistory\Exceptions\FileUploadException;

/**
 * @method stdClass request($method, $url, $accessToken, $query = [], $filename = null)
 */
trait Request
{
   /** 
    * @var string $httpClient GuzzleHttp Client
    */
    public static $httpClient;

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
    private static function request(
        string $method, 
        string $url,
        string $accessToken,
        array $query = [],
        string $filename = null)
    {
        try {

            $requestOptions = [
                'query' => array_merge([
                    'access_token' => $accessToken,
                    'output' => 'json',
                ], $query)
            ];

            if($method == 'post' && $filename) {
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
            
            $response = json_decode(Request::$httpClient->$method($url, $requestOptions)->getBody(), true);

            switch($method) {
                case 'get':
                    return (object) $response['tistory']['item'];
                    break;
                case 'post':
                    $result = [];

                    /** without 'status' */
                    foreach($response['tistory'] as $key => $value) {
                        if($key != 'status') {
                            $result[$key] = $value;
                        }
                    }
                    return (object) $result;
                    break;
            }
        }
        catch (RequestException $e) {
            if ($e->hasResponse()) {
                if($filename) {
                    throw new FileUploadException("The file ${filename} upload failed.", 400);
                }
                else {
                    $response = (object) json_decode($e->getResponse()->getBody(), true)['tistory'];
                    throw new BadResponseException($response->error_message, $response->status);
                }
            }
        }
    }
}

/**
 * Initialize GuzlleHttp\Client
 */
Request::$httpClient = new \GuzzleHttp\Client([
    'verify' => false,
    'base_uri' => 'https://www.tistory.com/apis/'
]);
