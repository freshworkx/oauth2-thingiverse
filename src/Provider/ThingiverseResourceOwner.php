<?php

namespace Freshworkx\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class ThingiverseResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;

    /**
     * Raw response
     *
     * @var array
     */
    protected $response;

    /**
     * Creates new resource owner.
     *
     * @param array  $response
     */
    public function __construct(array $response = array())
    {
        $this->response = $response;
    }

    /**
     * Get resource owner id
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->getValueByKey($this->response, 'id');
    }

    /**
     * Get resource owner email
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->getValueByKey($this->response, 'email');
    }

    /**
     * Get resource owner name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getValueByKey($this->response, 'name');
    }

    /**
     * Get resource owner url
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->getValueByKey($this->response, 'url');
    }

    /**
     * Get thumbnail
     *
     * @return string|null
     */
    public function getThumbnail(): ?string
    {
        return $this->getValueByKey($this->response, 'thumbnail');
    }

    /**
     * Get bio
     *
     * @return string|null
     */
    public function getBio(): ?string
    {
        return $this->getValueByKey($this->response, 'bio');
    }

    /**
     * Get location
     *
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->getValueByKey($this->response, 'location');
    }

    /**
     * Get registered
     *
     * @return string|null
     */
    public function getRegistered(): ?string
    {
        return $this->getValueByKey($this->response, 'registered');
    }

    /**
     * Get last_active
     *
     * @return string|null
     */
    public function getLastActive(): ?string
    {
        return $this->getValueByKey($this->response, 'last_active');
    }

    /**
     * Get things
     *
     * @return string|null
     */
    public function getThings(): ?string
    {
        return $this->getValueByKey($this->response, 'things_url');
    }

    /**
     * Get copies
     *
     * @return string|null
     */
    public function getCopies(): ?string
    {
        return $this->getValueByKey($this->response, 'copies_url');
    }

    /**
     * Get likes
     *
     * @return string|null
     */
    public function getLikes(): ?string
    {
        return $this->getValueByKey($this->response, 'likes_url');
    }

    /**
     * Get default_license
     *
     * @return string|null
     */
    public function getDefaultLicense(): ?string
    {
        return $this->getValueByKey($this->response, 'default_license');
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->response;
    }
}
