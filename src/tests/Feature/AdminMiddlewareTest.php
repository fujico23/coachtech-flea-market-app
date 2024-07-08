<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;

class AdminMiddlewareTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_can_admin_user_is_redirected()
    {
        $roleId = Role::factory()->create([
            'id' => 2,
        ]);
        $user = User::factory()->create(['role_id' => $roleId]);
        $response = $this->actingAs($user)->get('/admin');
        $response->assertRedirect(route('index'));
    }

    public function test_can_admin_route()
    {
        $roleId = Role::factory()->create([
            'id' => 1,
        ]);
        $user = User::factory()->create(['role_id' => $roleId]);
        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(200);
    }
}
