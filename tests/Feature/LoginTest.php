<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(401)
            ->assertJSON([
                'message' => 'Fail to authenticate',
            ]);
    }
    
    public function testUserLoginSuccessfuly()
    {
        $email = 'testlogin@domain.com';
        $password = 'jkrules';
        $user = User::factory()->create([
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $payload = ['email' => $email, 'password' => $password];
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
