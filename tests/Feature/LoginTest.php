<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{
    public function testUserLoginsSuccessfully()
    {
        $user = factory(User::class)->create([
            'email' => 'test@laravelacademy.org',
            'password' => bcrypt('test123'),
        ]);

        $payload = ['email' => 'test@laravelacademy.org', 'password' => 'test123'];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);

    }
}
