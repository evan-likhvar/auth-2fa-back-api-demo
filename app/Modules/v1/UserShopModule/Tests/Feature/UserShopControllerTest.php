<?php

namespace App\Modules\v1\UserShopModule\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserShopControllerTest extends TestCase
{
    public function testIndex()
    {
        Passport::actingAs(User::find(1));
        $response = $this->getJson('v1/rest-api/user-shop/index');
        $content = json_decode($response->getContent());
        $this->assertEquals(200, $response->status());
        $this->assertIsArray($content);
    }

    public function testShow()
    {
        Passport::actingAs(User::find(1));
        $response = $this->getJson('v1/rest-api/user-shop/1/index');
        $content = json_decode($response->getContent());
        $this->assertEquals(200, $response->status());
        $this->assertIsObject($content);
    }

    public function testStore()
    {
        Passport::actingAs(User::find(1));
        $response = $this->postJson('v1/rest-api/user-shop/store', ['user_id' => 1, 'shop_type_id' => 1]);
        $content = json_decode($response->getContent());
        $this->assertEquals(200, $response->status());
        $this->assertIsObject($content);
    }

    public function testUpdate()
    {
        Passport::actingAs(User::find(1));
        $response = $this->postJson('v1/rest-api/user-shop/3/update',
            ['name' => 'name','user_id' => 1, 'shop_type_id' => 1]);
        $content = json_decode($response->getContent());
        $this->assertEquals(200, $response->status());
        $this->assertIsObject($content);
    }
}
