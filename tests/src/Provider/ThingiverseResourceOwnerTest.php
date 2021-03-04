<?php

namespace Freshworkx\OAuth2\Client\Test\Provider;

use PHPUnit\Framework\TestCase;
use Freshworkx\OAuth2\Client\Provider\ThingiverseResourceOwner;

class ThingiverseResourceOwnerTest extends TestCase
{
    /**
     * @var ThingiverseResourceOwner
     */
    protected $user;

    protected function setUp(): void
    {
        $this->user = new ThingiverseResourceOwner([
            'id' => 1234567,
            'email' => 'foo@bar.com',
            'name' => 'foobar',
            'url' => 'https://api.thingiverse.com/users/foobar',
            'thumbnail' => 'https://cdn.thingiverse.com/site/img/default/avatar/avatar_maker_thumb_medium.jpg',
            'location' => '',
            'registered' => '2021-02-08T12:24:09+00:00',
            'last_active' => '2021-03-01T18:19:20+00:00',
            'things_url' => 'https://api.thingiverse.com/users/foobar/things',
            'copies_url' => 'https://api.thingiverse.com/users/foobar/copies',
            'likes_url' => 'https://api.thingiverse.com/users/foobar/likes',
            'default_license' => 'cc-sa',
        ]);
    }

    public function testGettersReturnNullWhenNoKeyExists()
    {
        $this->assertEquals(1234567, $this->user->getId());
        $this->assertNull($this->user->getBio());
    }

    public function testGetThumbnail()
    {
        $this->assertEquals('https://cdn.thingiverse.com/site/img/default/avatar/avatar_maker_thumb_medium.jpg', $this->user->getThumbnail());
    }

    public function testGetUrl()
    {
        $this->assertEquals('https://api.thingiverse.com/users/foobar', $this->user->getUrl());
    }

    public function testGetCopies()
    {
        $this->assertEquals('https://api.thingiverse.com/users/foobar/copies', $this->user->getCopies());
    }

    public function testGetLastActive()
    {
        $this->assertEquals('2021-03-01T18:19:20+00:00', $this->user->getLastActive());
    }

    public function testGetLikes()
    {
        $this->assertEquals('https://api.thingiverse.com/users/foobar/likes', $this->user->getLikes());
    }

    public function testGetLocation()
    {
        $this->assertEmpty($this->user->getLocation());
    }

    public function testGetThings()
    {
        $this->assertEquals('https://api.thingiverse.com/users/foobar/things', $this->user->getThings());
    }

    public function testGetRegistered()
    {
        $this->assertEquals('2021-02-08T12:24:09+00:00', $this->user->getRegistered());
    }

    public function testGetDefaultLicense()
    {
        $this->assertEquals('cc-sa', $this->user->getDefaultLicense());
    }

    public function testCanGetAllDataBackAsAnArray()
    {
        $data = $this->user->toArray();

        $expectedData = [
            'id' => 1234567,
            'email' => 'foo@bar.com',
            'name' => 'foobar',
            'url' => 'https://api.thingiverse.com/users/foobar',
            'thumbnail' => 'https://cdn.thingiverse.com/site/img/default/avatar/avatar_maker_thumb_medium.jpg',
            'location' => '',
            'registered' => '2021-02-08T12:24:09+00:00',
            'last_active' => '2021-03-01T18:19:20+00:00',
            'things_url' => 'https://api.thingiverse.com/users/foobar/things',
            'copies_url' => 'https://api.thingiverse.com/users/foobar/copies',
            'likes_url' => 'https://api.thingiverse.com/users/foobar/likes',
            'default_license' => 'cc-sa',
        ];

        $this->assertEquals($expectedData, $data);
    }
}
