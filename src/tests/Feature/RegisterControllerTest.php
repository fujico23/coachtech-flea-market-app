<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class RegisterControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // 必要なロールデータを挿入
        Role::create(['id' => 1, 'name' => 'Admin']);
        Role::create(['id' => 2, 'name' => 'User']);
    }
    /** @test*/
    public function test_user_can_register()
    {
        $data = [
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role_id' => 2,
        ];

        $response = $this->post('/register', $data);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('users', ['email' => 'testuser@example.com']);
        $this->assertTrue(Hash::check('password123', User::where('email', 'testuser@example.com')->first()->password));
    }
}
