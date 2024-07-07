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
    }

    public function test_can_profile()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('profile'));
        $response->assertStatus(200);
    }

    public function test_can_profile_update_with_existing_address()
    {
        $user = User::factory()->create();
        //既存のアドレス
        $address = Address::factory()->create([
            'user_id' => $user->id,
            'type' => '自宅',
        ]);

        //プロフィール更新用データの準備
        $data = [
            'name' => 'Updated User',
            'postal_code' => '1234567',
            'address' => 'Updated Address',
            'building_name' => 'Updated Building',
            'type' => '自宅',
        ];

        $response = $this->actingAs($user)->post(route('profile.update'), $data);
        $response->assertRedirect();
        $response->assertSessionHas('success', 'プロフィールが更新されました');

        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Updated User']);
        $this->assertDatabaseHas('addresses', [
            'id' => $address->id,
            'user_id' => $user->id,
            'postal_code' => '1234567',
            'address' => 'Updated Address',
            'building_name' => 'Updated Building',
            'type' => '自宅',
        ]);
    }

    public function test_can_profile_update_with_new_address()
    {
        $user = User::factory()->create();

        //プロフィール新規登録用データの準備
        $data = [
            'name' => 'Test User',
            'postal_code' => '1234567',
            'address' => 'Test Address',
            'building_name' => 'Test Building',
            'type' => '自宅',
        ];

        $response = $this->actingAs($user)->post(route('profile.update'), $data);
        $response->assertRedirect();
        $response->assertSessionHas('success', 'プロフィールが更新されました');

        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Test User']);
        $this->assertDatabaseHas('addresses', [
            'user_id' => $user->id,
            'postal_code' => '1234567',
            'address' => 'Test Address',
            'building_name' => 'Test Building',
            'type' => '自宅',
        ]);
    }

    /* public function test_can_profile_update_with_image()
    {
        Storage::fake('local');

        $user = User::factory()->create();

        $data = [
            'name' => 'Test User',
            'icon_image' => UploadedFile::fake()->image('icon_image.jpg'),
            'postal_code' => '1234567',
            'address' => 'Test Address',
            'building_name' => 'Test Building',
            'type' => '自宅',
        ];

        $response = $this->actingAs($user)->post(route('profile.update'), $data);

        Storage::disk('local')->assertExists('public/icon_image/' . $user->id . '/icon_image.jpg');
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Test User']);
        $this->assertDatabaseHas('addresses', [
            'user_id' => $user->id,
            'postal_code' => '1234567',
            'address' => 'Test Address',
            'building_name' => 'Test Building',
            'type' => '自宅',
        ]);
    }
        */
}
