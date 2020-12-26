<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ArticleTest extends TestCase
{
    public function testsArticlesAreCreatedCorrectly()
    {
        $user = User::factory()->create()?: new User;
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer {$token}"];
        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
        ];
        $this->json('POST', '/api/articles', $payload, $headers)
            ->assertStatus(201)
            ->assertJson(['id' => 1, 'title' => 'Lorem', 'body' => 'Ipsum']);
    }
}
