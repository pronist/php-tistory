# php-tistory

Tistory API for PHP application

# Installation

```bash
composer require pronist/tistory
```

# Getting started

### Redirect Permission Page

```php
$redirectUrl = Tistory\Auth::getPermissionUrl('__CLIENT_ID__', '__REDIRECT_URI__');
header("Location: $redirectUrl");
```

### OAuth2 Authentication

```php
use Tistory\Exceptions\AuthenticationException;

try {
    $code = $_GET['code'];

    $access_token = Tistory\Auth::getAccessToken(        
        '__CLIENT_ID__',
        '__CLIENT_SECRET__',
        '__REDIRECT_URI__',
        $code // Authentication code
    );
}
catch(AuthenticationException $e) {
    echo $e->getDescription();
}
```

### Request

```php
use Tistory\Exceptions\BadResponseException;

try {
    if($access_token) {
        $response = Tistory\Post::attach($access_token, [
            'blogName' => '__BLOG_NAME__',
            'uploadedfile' => fopen('__FILE_PATH__', 'r')
        ]);
        echo $response->url;
    }
}
catch(BadResponseException $e) {
    echo $e->getMessage();
}
```

# Namespace

### Tistory API

|Namespace|description|
----------|-----------|
|**Tistory\Auth**| OAuth2 Authentication
|**Tistory\Blog**| Tistory Blog API
|**Tistory\Category**| Tistory Category API
|**Tistory\Comment**| Tistory Comment API
|**Tistory\Post**| Tistory Post API

### Exceptions

|Namespace|description|
----------|-----------|
|**Tistory\Exceptions\AuthenticationException**| OAuth2 Authentication
|**Tistory\Exceptions\BadResponseException**| Bad Response

# Methods

### Tistory\Auth

|Name|description|
-----|-----------|
|**Tistory\Auth::getPermissionUrl($clientId, $redirectUri)**| Getting permission redirect url
|**Tistory\Auth::getAccessToken($clientId, $clientSecret, $redirectUri, $code)**| Tistory OAuth2 Access Token

### Tistory\Blog

|Name|description|
-----|-----------|
|**Tistory\Blog::info($access_token, $options = [])**| Getting Tistory blog info

### Tistory\Category

|Name|description|
-----|-----------|
|**Tistory\Category::list($access_token, $options = [])**| Getting Tistory category list

### Tistory\Comment

|Name|description|
-----|-----------|
|**Tistory\Comment::newest($access_token, $options = [])**| Getting newest comments
|**Tistory\Comment::list($access_token, $options = [])**| Getting comments list
|**Tistory\Comment::write($access_token, $options = [])**| Writing a comment
|**Tistory\Comment::modify($access_token, $options = [])**| Modifying a comment
|**Tistory\Comment::delete($access_token, $options = [])**| Deleting a comment

### Tistory\Post

|Name|description|
-----|-----------|
|**Tistory\Post::list($access_token, $options = [])**| Getting posts list
|**Tistory\Post::read($access_token, $options = [])**| Reading a post
|**Tistory\Post::write($access_token, $options = [])**| Writing a post
|**Tistory\Post::modify($access_token, $options = [])**| Modifying a post
|**Tistory\Post::attach($access_token, $options = [])**| Attaching a file

# Reference

<https://tistory.github.io/document-tistory-apis/>