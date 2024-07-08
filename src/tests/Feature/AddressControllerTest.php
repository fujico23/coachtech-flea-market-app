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

    public function test_can_select_address()
    {
        $user = User::factory()->create();
        $address = Address::factory()->create([
            'user_id' => $user->id,
            'is_default' => false,
        ]);
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);
        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);

        $this->actingAs($user)
            ->post(route('address.select', compact('item')), [
                'address_id' => $address->id,
            ]);

        $this->assertDatabaseHas('addresses', [
            'is_default' => true,
        ]);
    }

    public function test_can_edit_index_address()
    {
        $user = User::factory()->create();
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);
        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);
        $address = Address::factory()->create([
            'user_id' => $user->id,
        ]);
        $response = $this->actingAs($user)->get(route('address.edit.index', compact('item', 'address')));
        $response->assertStatus(200);
    }

    public function test_can_edit_address()
    {
        $user = User::factory()->create();
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);
        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);
        $address = Address::factory()->create([
            'user_id' => $user->id,
        ]);
        $response = $this->actingAs($user)->get(route('address.edit', compact('item', 'address')));
        $response->assertStatus(200);
    }

    public function test_can_update_address()
    {
        $user = User::factory()->create();
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);
        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);

        //元のアドレス
        $address = Address::factory()->create([
            'user_id' => $user->id,
        ]);
        $response = $this->actingAs($user)->post(route('address.update', compact('item', 'address')), [
            'postal_code' => '7654321',
            'address' => 'UpdateAddress',
            'building_name' => 'UpdateBuildingName',
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('success', '住所が更新されました!');

        $this->assertDatabaseHas(
            'addresses',
            [
                'id' => $address->id,
                'user_id' => $user->id,
                'postal_code' => '7654321',
                'address' => 'UpdateAddress',
                'building_name' => 'UpdateBuildingName',
            ]
        );
    }


    public function test_can_delete_address()
    {
        $user = User::factory()->create();
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);
        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);
        $address = Address::factory()->create(
            [
                'user_id' => $user->id,
            ],
        );
        $response = $this->actingAs($user)->delete(route('address.destroy', compact('item', 'address')));
        $response->assertStatus(302);
        $response->assertSessionHas('success', '住所が削除されました!');
        $this->assertDatabaseMissing('addresses', [
            'id' => $address->id
        ]);
    }

    public function test_can_create_address()
    {
        $user = User::factory()->create();
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);
        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($user)->get(route('address.create', compact('item')));
        $response->assertStatus(200);
    }

    public function test_can_store_address()
    {
        $user = User::factory()->create();
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);
        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);
        $address = Address::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->post(route('address.store', compact('item')), [
            'user_id' => $user->id,
            'postal_code' => '1234567',
            'address' => 'TestAddress',
            'building_name' => 'TestBuildingName',
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('success', '配送先住所が追加されました!');

        $this->assertDatabaseHas('addresses', [
            'id' => $address->id,
        ]);
    }
}
