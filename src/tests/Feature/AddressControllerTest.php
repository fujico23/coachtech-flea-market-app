<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use App\Models\Item;
use App\Models\Category;

class AddressControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_can_index_address()
    {
        $user = User::factory()->create();
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);
        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);
        $response = $this->actingAs($user)->get(route('address.index', ['item' => $item->id,]));
        $response->assertStatus(200);
    }

    /*   public function test_can_select_address()
    {
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id]);
        $item = Item::factory()->create();

        // デバッグ情報を追加
        dump($user->toArray());
        dump($address->toArray());
        dump($item->toArray());

        $this->actingAs($user)
            ->post(route('address.select', ['item' => $item->id]), ['address_id' => $address->id]);

        $this->assertDatabaseHas('addresses', [
            'id' => $address->id,
            'is_default' => true,
        ]);
        $this->assertDatabaseMissing('addresses', [
            'user_id' => $user->id,
            'is_default' => false,
        ]);
    }

    public function test_can_update_address()
    {
        $user = User::factory()->create();
        $address = Address::factory()->create([
            'user_id' => $user->id,
            'postal_code' => '1234567',
            'address' => 'TestAddress',
            'building_name' => null,
            'type' => '自宅',
            'is_default' => true,
        ]);

        $this->assertDatabaseHas(
            'addresses',
            [
                'id' => $address->id,
                'user_id' => $user->id,
                'postal_code' => $address->postal_code,
                'address' => $address->address,
                'building_name' => $address->building,
            ]
        );
    }

    public function test_can_delete_address()
    {
        $user = User::factory()->create();
        $address = Address::factory()->create(
            ['user_id' => $user->id],
        );
        $item = Item::factory()->create();
        $response = $this->delete("/address/{$item->id}/{$address->id}/delete" . $address->id);
        $this->assertDatabaseMissing('addresses', ['id' => $address->id]);
    }
        */
}
