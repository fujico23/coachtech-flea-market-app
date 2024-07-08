<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Address;
use App\Models\Comment;

class AdminControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_can_admin_index()
    {
        $roleId = Role::factory()->create([
            'id' => 1,
        ]);
        $admin = User::factory()->create(['role_id' => $roleId]);

        $response = $this->actingAs($admin)->get(route('admin.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.admin_index');
        $response->assertViewHas('users');
    }
    /** @test */
    public function admin_show_displays_user_details()
    {
        $roleId = Role::factory()->create([
            'id' => 1,
        ]);
        $roleName = Role::factory()->create([
            'name' => 'administrator',
        ]);
        $admin = User::factory()->create(['role_id' => $roleId]);
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => $roleName]);

        $homeAddress = Address::factory()->create([
            'user_id' => $user->id,
            'type' => '自宅',
        ]);
        $shippingAddresses = Address::factory()->count(2)->create([
            'user_id' => $user->id,
            'type' => 'その他',
        ]);


        $comments = Comment::factory()->count(5)->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($admin)->get(route('admin.show', $user));

        $response->assertStatus(200);
        $response->assertViewIs('admin.admin_detail');
        $response->assertViewHas('user', $user);
        $response->assertViewHas('roles', function ($viewRoles) use ($role) {
            return $viewRoles->contains($role);
        });
        $response->assertViewHas('homeAddress', $homeAddress);
        $response->assertViewHas('shippingAddresses');
        $response->assertViewHas('comments');
    }

    public function test_can_role_update()
    {
        $adminRoleId = Role::factory()->create(['id' => 1,])->id;
        $userRoleId = Role::factory()->create(['id' => 2,])->id;
        $admin = User::factory()->create([
            'role_id' => $adminRoleId,
        ]);
        $user = User::factory()->create([
            'role_id' => $userRoleId,
        ]);

        $response = $this->actingAs($admin)->patch(route('role.update', compact('user')), [
            'role_id' => $adminRoleId,
        ]);

        $this->assertEquals($adminRoleId, $user->fresh()->role_id);
    }
}
