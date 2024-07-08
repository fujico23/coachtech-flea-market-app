<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderStatus;

class PurchaseControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_can_purchase_index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('purchase.index'));
        $response->assertStatus(200);
    }

    public function test_can_purchase()
    {
        $user = User::factory()->create();
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);
        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);
        $response = $this->actingAs($user)->get(route('purchase.index', $item));
        $response->assertStatus(200);
    }

    public function test_can_purchase_select()
    {
        $user = User::factory()->create();
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);
        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);
        $response = $this->actingAs($user)->get(route('purchase.select', $item));
        $response->assertStatus(200);
    }
    public function test_can_purchase_update_payment()
    {
        $user = User::factory()->create();
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);
        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);
        $orderStatus = OrderStatus::factory()->create()->id;
        $response = $this->actingAs($user)->post(route('purchase.update.payment', $item), [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'status' => $orderStatus,
            'pay_method' => 'card',
        ]);
        $response->assertRedirect();
        $response->assertSessionHas('success', '支払い方法が選択されました');

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'pay_method' => 'card',
        ]);
    }
}
