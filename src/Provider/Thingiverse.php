<?php

/*
 * Thingiverse OAuth2 Provider
 * (c) FreshWorkX - https://github.com/freshworkx/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freshworkx\OAuth2\Client\Provider;

use Freshworkx\OAuth2\Client\Provider\Exception\ThingiverseIdentityProviderException;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

/**
 * Thingiverse.
 *
 * @author Jens Neumann <info@freshworkx.de>
 */
class Thingiverse extends AbstractProvider
{
    use BearerAuthorizationTrait;

    /**
     * Domain
     *
     * @var string $domain
     */
    public $domain = 'https://www.thingiverse.com';

    /**
     * Api domain
     *
     * @var string $apiDomain
     */
    public $apiDomain = 'https://api.thingiverse.com';

    /**
     * Get authorization url to begin OAuth flow
     *
     * @return string
     */
    public function getBaseAuthorizationUrl(): string
    {
        return $this->domain . '/login/oauth/authorize';
    }

    /**
     * Get access token url to retrieve token
     *
     * @param array $params
     *
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params): string
    {
        return $this->domain . '/login/oauth/access_token';
    }

    /**
     * Get provider url to fetch user details
     *
     * @param AccessToken $token
     *
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token): string
    {
        return $this->apiDomain . '/users/me';
    }

    /**
     * Get the default scopes used by this provider.
     *
     * This should not be a complete list of all scopes, but the minimum
     * required for the provider user interface!
     *
     * @return array
     */
    protected function getDefaultScopes(): array
    {
        return [];
    }

    /**
     * Check a provider response for errors.
     *
     * @param ResponseInterface $response
     * @param array|string $data
     *
     * @return void
     * @throws IdentityProviderException
     */
    protected function checkResponse(ResponseInterface $response, $data): void
    {
        if ($response->getStatusCode() >= 400) {
            throw ThingiverseIdentityProviderException::clientException($response, $data);
        } elseif (isset($data['error'])) {
            throw ThingiverseIdentityProviderException::oauthException($response, $data);
        }
    }

    /**
     * Generate a user object from a successful user details request.
     *
     * @param array $response
     * @param AccessToken $token
     *
     * @return ResourceOwnerInterface
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new ThingiverseResourceOwner($response);
    }
}
