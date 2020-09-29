<?php

namespace App\Modules\v1\Settings\Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;

class SettingsControllerTest extends TestCase
{
    public function testSettingsIndex()
    {
        $response = $this->getJson('/v1/settings');
        $content = json_decode($response->getContent());
        $response->assertStatus(200);
        $this->assertIsArray($content);
    }

    public function testSettingsStore()
    {
        $data = [
            "name" => Str::random(20),
            "value" => Str::random(20),
            "type_id" => 1,
            "default_value" => "15",
            "description" => "Test Description",
        ];

        $response = $this->postJson('/v1/settings/store', $data);
        $content = json_decode($response->getContent());

        $response->assertStatus(200);
        $this->assertIsObject($content);
    }

    public function testSettingsUpdate()
    {
        $data = [
            "name" => Str::random(20),
            "value" => Str::random(20),
            "type_id" => 1,
            "default_value" => "15",
            "description" => "Test Description",

        ];
        $response = $this->putJson('/v1/settings/1/update', $data);
        $content = json_decode($response->getContent());
        $response->assertStatus(200);
        $this->assertIsObject($content);
    }

    public function testSettingShow()
    {
        $response = $this->getJson('/v1/settings/1/show');
        $content = json_decode($response->getContent());
        $response->assertStatus(200);
        $this->assertIsObject($content);
    }
}
