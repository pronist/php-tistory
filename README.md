# Tistory API for PHP

<p>
    <img src="https://travis-ci.com/pronist/php-tistory-api.svg?branch=master">
    <img src="https://github.styleci.io/repos/155703406/shield?branch=master" alt="StyleCI">
</p>

This is a library for **Tistory API with PHP**. You can reference [Tistory API](https://tistory.github.io/document-tistory-apis/) for using this library.

## Installation

```bash
composer require pronist/tistory
```

## Getting started

```php
require "vendor/autoload.php";

use Pronist\Tistory;

$code = $_GET['code'];

if ($code) {
    $accessToken = Tistory\Auth::getAccessToken(
        '__CLIENT_ID__',
        '__CLIENT_SECRET__',
        '__REDIRECT_URI__',
        $code // Authentication code
    );
    Tistory\Blog::info($accessToken, [
        'output' => 'json'
    ]);
} else {
    $redirectUrl = Tistory\Auth::getPermissionUrl(
        '__CLIENT_ID__',
        '__REDIRECT_URI__',
        'code'
    );
    header("Location: $redirectUrl");
}
```

## Authentication

### Tistory\Auth::getPermissionUrl(string $clientId, string $redirectUri, string $state = null)

Return tistory permission Url for **Authorization**

* clientId: Tistory API client id
* redirectUri: Tistory API redirect uri
* responseType: 'code', or 'token'
* state: CSRF Token

```php
$redirectUrl = Tistory\Auth::getPermissionUrl(
    '__CLIENT_ID__',
    '__REDIRECT_URI__',
    'code'
);
```

### Tistory\Auth::getAccessToken(string $clientId, string $clientSecret, string $redirectUri, string $code)

Request ```https://www.tistory.com/oauth/access_token```

* clientId: Tistory API client id
* clientSecret: Tistory API client secret
* redirectUri: Tistory API redirect uri
* code: Authentication code

```php
$response = Tistory\Auth::getAccessToken(
    '__TISTORY_CLIENT_ID__',
    '__TISTORY_CLIENT_SECRET__',
    '__TISTORY_CALLBACK__',
    $code // Authentication code
);
```

## Tistory API

You can use a same way associated classes like this; \
```Tistory\__CATEGORY__::__METHOD__(string $accessToken, array $options = []): string```

* accessToken: Tistory Access Token
* options: Tistory API request parameters

### Categories

* [Tistory\Blog](https://github.com/pronist/tistory/blob/master/src/Blog.php)
* [Tistory\Category](https://github.com/pronist/tistory/blob/master/src/Category.php)
* [Tistory\Post](https://github.com/pronist/tistory/blob/master/src/Post.php)
* [Tistory\Comment](https://github.com/pronist/tistory/blob/master/src/Comment.php)

**Note**. When using ```Tistory\Post::attach```, Just using ```fopen``` with ```uploadedfile``` parameter. Reference [Guzzle 6](http://docs.guzzlephp.org/en/stable/request-options.html#multipart).

## License

[MIT](https://github.com/pronist/php-tistory-api/blob/master/LICENSE)

Copyright 2020. [SangWoo Jeong](https://github.com/pronist). All rights reserved.
