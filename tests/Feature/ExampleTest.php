<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testBasic2faTest()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/home');
        $content = json_decode($response->getContent());
        //dd($response);
        $response->assertStatus(200);
    }
}
