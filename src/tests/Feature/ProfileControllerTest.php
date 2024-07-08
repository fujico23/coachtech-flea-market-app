<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use App\Models\Role;
use Illuminate\Http\UploadedFile;
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

    public function test_can_profile_update()
    {
        Storage::fake('local');

        //既存のアドレス
        $user = User::factory()->create();
        $address = Address::factory()->create([
            'user_id' => $user->id,
            'type' => '自宅',
        ]);

        $response = $this->actingAs($user)->post(route('profile.update'), [
            'name' => 'New User',
            'postal_code' => '1234567',
            'address' => 'Nes Address',
            'building_name' => 'New Building',
            'type' => '自宅',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'プロフィールが更新されました');

        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'New User',]);
        $this->assertDatabaseHas('addresses', [
            'id' => $address->id,
            'user_id' => $user->id,
            'postal_code' => '1234567',
            'address' => 'Nes Address',
            'building_name' => 'New Building',
            'type' => '自宅',
        ]);
    }
}
