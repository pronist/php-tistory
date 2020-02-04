<?php

namespace Pronist\Tistory;

use GuzzleHttp\Psr7;

class Auth
{
   /**
    * Getting permission redirect url
    *
    * @param string $clientId
    * @param string $redirectUri
    *
    * @return string
    */
    public static function getPermissionUrl(string $clientId, string $redirectUri, string $responseType, string $state = null)
    {
        $query = http_build_query([
            "client_id"     => $clientId,
            "redirect_uri"  => $redirectUri,
            "state"         => $state,
            "response_type" => $responseType
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
    public static function getAccessToken(string $clientId, string $clientSecret, string $redirectUri, string $code)
    {
        $httpClient = new \GuzzleHttp\Client([ 'verify' => false ]);

        $response = $httpClient->get('https://www.tistory.com/oauth/access_token', [
            'query' => [
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
                'redirect_uri'  => $redirectUri,
                'code'          => $code,
                'grant_type'    => 'authorization_code'
            ]
        ]);

        return explode('=', $response->getBody())[1];
    }
}
