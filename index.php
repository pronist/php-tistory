<?php

require_once('vendor/autoload.php');

use Tistory\Exceptions\AuthenticationException;
use Tistory\Exceptions\FileUploadException;

$code = $_GET['code'];

if($code) {
    $access_token = null;
    try {
        $access_token = Tistory\Auth::getAccessToken(        
            'b98fdb7590d225bb33ecc8a8753f09ee',
            'b98fdb7590d225bb33ecc8a8753f09eecb8e3b66ba1e40b950948c2a758a0c8dadf3a7bd',
            'http://localhost',
            $code // Authentication code
        );
    }
    catch(AuthenticationException $e) {
        echo $e->getDescription();
    }
    try {
        if($access_token) {    
            // $file = Tistory\Post::attach($access_token, [
            //     'blogName' => '__BLOG_NAME__'
            // ], '__FILE_NAME__');
    
            // echo $file->url;
        }
    }
    catch(FileUploadException $e) {
        echo $e->getMessage();
    }
}
else {
    $redirectUrl = Tistory\Auth::getPermissionUrl('b98fdb7590d225bb33ecc8a8753f09ee', 'http://localhost');
    header("Location: $redirectUrl");    
}