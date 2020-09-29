<?php

namespace App\Modules\v1\UserShopModule\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserShopControllerTest extends TestCase
{

    public function testIndex()
    {
        $response = $this->getJson('v1/rest-api/user-shop/index');
        $content = json_decode($response->getContent());
        $this->assertEquals(200, $response->status());
        $this->assertIsArray($content);
    }

    public function testShow()
    {
        $response = $this->getJson('v1/rest-api/user-shop/1/index');
        $content = json_decode($response->getContent());
        $this->assertEquals(200, $response->status());
        $this->assertIsObject($content);
    }

    public function testStore()
    {
        $response = $this->postJson('v1/rest-api/user-shop/store', ['user_id' => 1, 'shop_type_id' => 1]);
        $content = json_decode($response->getContent());
        $this->assertEquals(200, $response->status());
        $this->assertIsObject($content);
    }

    public function testUpdate()
    {
        $response = $this->postJson('v1/rest-api/user-shop/3/update', ['name' => 'name']);
        $content = json_decode($response->getContent());
        $this->assertEquals(200, $response->status());
        $this->assertIsObject($content);
    }

}
