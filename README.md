# Thingiverse Provider for OAuth 2.0 Client
[![GitHub tag](https://img.shields.io/github/tag/freshworkx/oauth2-thingiverse.svg)](https://github.com/freshworkx/oauth2-thingiverse/blob/main/tags)
[![GitHub license](https://img.shields.io/github/license/freshworkx/oauth2-thingiverse.svg)](https://github.com/freshworkx/oauth2-thingiverse/blob/main/LICENSE)
[![build](https://github.com/freshworkx/oauth2-thingiverse/actions/workflows/build.yml/badge.svg?branch=main)](https://github.com/freshworkx/oauth2-thingiverse/actions/workflows/build.yml)
[![codecov](https://codecov.io/gh/freshworkx/oauth2-thingiverse/branch/main/graph/badge.svg?token=oPkmgmGDJy)](https://codecov.io/gh/freshworkx/oauth2-thingiverse)

This package provides Thingiverse OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Hint

This package is archived, becomes a read-only repository. As a third-party provider this is removed from [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client) in favor of the new OpenAPI from Ultimaker.
See [PR](https://github.com/thephpleague/oauth2-client/pull/1021)

## Requirements

The following versions of PHP are supported.

* PHP 7.3
* PHP 7.4
* PHP 8.0

## Installation

To install, use composer:

```
composer require freshworkx/oauth2-thingiverse
```

Or add the following to your `composer.json` file.

```json
{
    "require": {
        "freshworkx/oauth2-thingiverse": "^0.0.7"
    }
}
```

## Usage

Usage is the same as The League's OAuth client, using `\Freshworkx\OAuth2\Client\Provider\Thingiverse` as the provider.

### Authorization Code Flow

```php
<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

$provider = new Freshworkx\OAuth2\Client\Provider\Thingiverse([
    'clientId'     => '{thingiverse-client-id}',
    'clientSecret' => '{thingiverse-client-secret}',
    'redirectUri'  => 'https://example.com/callback-url',
    'responseType' => 'token',
]);

if ( ! isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl                 = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the user's details
        $user = $provider->getResourceOwner($token);
        printf('Hello %s!', $user->getName());

    } catch (Exception $e) {

        // Failed to get user details
        exit('Error...');
    }

    // Use this to interact with an API on the users behalf
    echo $token->getToken();
}
```

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/freshworkx/oauth2-thingiverse/blob/master/CONTRIBUTING.md) for details.


## Credits

- [Jens Neumann](https://github.com/freshworkx)


## License

The MIT License (MIT). Please see [License File](https://github.com/freshworkx/oauth2-thingiverse/blob/master/LICENSE) for more information.
