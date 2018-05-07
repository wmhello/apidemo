<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->withHeaders([
            'X-Header' => 'LaravelAcademy',
        ])->json('POST', '/api/login', ['email' => 'admin@test.com', 'password' => 'toptal']);

        $response
            ->assertStatus(200)
            ->assertJson([
              'data' => [
                  'name' => 'admin'
              ],
            ]);
    }
}
