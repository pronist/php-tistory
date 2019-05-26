# tistory

Tistory API for PHP application

# Installation

```bash
composer require pronist/tistory
```

# Getting started

```php
require "vendor/autoload.php";

use Pronist\Tistory;

$code = $_GET['code'];
if($code) {
    $access_token = Tistory\Auth::getAccessToken(        
        '__CLIENT_ID__',
        '__CLIENT_SECRET__',
        '__REDIRECT_URI__',
        $code // Authentication code
    );
    print_r(Tistory\Blog::info($access_token));
}
else {
    $redirectUrl = Tistory\Auth::getPermissionUrl(
        '__CLIENT_ID__', 
        '__REDIRECT_URI__',
        'code'
    );
    header("Location: $redirectUrl");
}
```

# Authentication

### Tistory\Auth::getPermissionUrl(string $clientId, string $redirectUri, string $state = null)

Return tistory permission Url for **Authorization**

#### Parameters

* clientId: Tistory API client id
* redirectUri: Tistory API redirect uri
* responseType: 'code', or 'token'
* state: CSRF Token

#### Usage

```php
$redirectUrl = Tistory\Auth::getPermissionUrl(
    '__CLIENT_ID__', 
    '__REDIRECT_URI__',
    'code'
);
```

### Tistory\Auth::getAccessToken(string $clientId, string $clientSecret, string $redirectUri, string $code)

Request ```https://www.tistory.com/oauth/access_token```

#### Parameters

* clientId: Tistory API client id
* clientSecret: Tistory API client secret
* redirectUri: Tistory API redirect uri
* code: Access Token request code

#### Usage

```php
$response = Tistory\Auth::getAccessToken(
    '__TISTORY_CLIENT_ID__',
    '__TISTORY_CLIENT_SECRET__',
    '__TISTORY_CALLBACK__',
    $code
);
```

# Tistory API

#### Parameters

* access_token: Tistory Access Token
* options: Tistory API request parameters

### Tistory\Blog::info(string $access_token, array $options = [])

Getting Tistory blog info

#### Usage

```php
$response = Tistory\Blog::info($access_token);
```

### Tistory\Category::list(string $access_token, array $options = [])

Getting Tistory category list

#### Usage

```php
$response = Tistory\Category::list($access_token, [
    'blogName' => 'example'
]);
```

### Tistory\Comment::newest(string $access_token, array $options = [])

Getting newest comments

#### Usage

```php
$response = Tistory\Comment::newest($access_token, [
    'blogName' => 'example',
    'page' => '1',
    'count' => '10'
]);
```

### Tistory\Comment::list(string $access_token, array $options = [])

Getting comments list

#### Usage

```php
$response = Tistory\Comment::list($access_token, [
    'blogName' => 'example',
    'postId' => '1',
]);
```

### Tistory\Comment::write(string $access_token, array $options = [])

Writing a comment

#### Usage

```php
$response = Tistory\Comment::write($access_token, [
    'blogName' => 'example',
    'page' => '1',
    'content' => 'Hello, world!'
]);
```

### Tistory\Comment::modify(string $access_token, array $options = [])

Modifying a comment

#### Usage

```php
$response = Tistory\Comment::modify($access_token, [
    'blogName' => 'example',
    'postId' => '1',
    'commentId' => '1',
    'content' => 'Hello, world!'
]);
```

### Tistory\Comment::delete(string $access_token, array $options = [])

Deleting a comment

#### Usage

```php
$response = Tistory\Comment::delete($access_token, [
    'blogName' => 'example',
    'postId' => '1',
    'commentId' => '1'
]);
```

### Tistory\Post::list(string $access_token, array $options = [])

Getting posts list

#### Usage

```php
$response = Tistory\Post::list($access_token, [
    'blogName' => 'example',
    'page' => '1'
]);
```

### Tistory\Post::read(string $access_token, array $options = [])

Reading a post

#### Usage

```php
$response = Tistory\Post::read($access_token, [
    'blogName' => 'example',
    'postId' => '1'
]);
```

### Tistory\Post::write(string $access_token, array $options = [])

Writing a post

#### Usage

```php
$response = Tistory\Post::write($access_token, [
    'blogName' => 'example',
    'title' => 'Hello, world!'
]);
```

### Tistory\Post::modify(string $access_token, array $options = [])

Modifying a post

#### Usage

```php
$response = Tistory\Post::modify($access_token, [
    'blogName' => 'example',
    'postId' => '1',
    'title' => 'Hello, world!'
]);
```

### Tistory\Post::attach(string $access_token, array $options = [])

Attaching a file

#### Usage

```php
$response = Tistory\Post::attach($access_token, [
    'blogName' => 'example',
    'uploadedfile' => fopen('preview.jpg', 'r')
]);
```

# Reference

<https://tistory.github.io/document-tistory-apis/>