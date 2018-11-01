<?php

namespace Tistory;

use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

use Tistory\Traits\Request;
use Tistory\Traits\Token;

use Tistory\Exceptions\AuthenticationException;

/**
 * @method string getPermissionUrl($clientId, $redirectUri)
 * @method string getAccessToken($clientId, $clientSecret, $redirectUri, $code)
 */
class Auth 
{
    use Request;

   /**
    * Getting permission redirect url
    *
    * @param string $clientId
    * @param string $redirectUri
    *
    * @return string
    */
    public static function getPermissionUrl(string $clientId, string $redirectUri, string $state = null)
    {
        $query = http_build_query([
            "client_id" => $clientId,
            "redirect_uri" => $redirectUri,
            "state" => $state,
            "response_type" => "code"
        ]);
        return "https://www.tistory.com/oauth/authorize/?$query";
    }
    
   /**
    * Getting Tistory OAuth2 Access Token
    *
    * @param string $clientId
    * @param string $clientSecret
    * @param string $redirectUri
    * @param string $code
    *
    * @return string
    */
    public static function getAccessToken(
        string $clientId, 
        string $clientSecret, 
        string $redirectUri, 
        string $code)
    {
        try {
            $response = self::$httpClient->get('https://www.tistory.com/oauth/access_token', [
                'query' => [
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                    'redirect_uri' => $redirectUri,
                    'code' => $code,
                    'grant_type' => 'authorization_code'
                ]
            ]);
            return explode('=', $response->getBody())[1];
        }
        catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = Psr7\str($e->getResponse());
                $error = [];
                preg_match("/error\=(.*)\&error_description\=(.*)$/", $response, $error);
                throw new AuthenticationException(
                    $error[1], // error
                    $error[2], // error_description
                    400 // status
                );
            }
        }
    }
}