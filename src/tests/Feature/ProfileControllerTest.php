<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class ProfileControllerTest extends TestCase
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
        Role::factory()->create(['id' => 1, 'name' => 'Admin']);
        Role::factory()->create(['id' => 2, 'name' => 'User']);

        // テスト用ディスクを使用
        Storage::fake('testing');
    }

    public function test_can_profile()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('profile'));
        $response->assertStatus(200);
    }
}
