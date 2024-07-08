<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Imagick;

class SellControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    use WithFaker;

    public function test_can_sell_index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('sell.show', $user));
        $response->assertStatus(200);
    }

    public function test_can_sell_edit()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('sell'));
        $response->assertStatus(200);
    }

    public function test_can_sell_listing()
    {
        // ログインユーザーを作成
        $user = User::factory()->create();
        $this->actingAs($user);

        // 画像アップロードのためのストレージをモック
        Storage::fake('local');

        // POSTリクエストを送信
        $response = $this->post(route('sell.listing'), [
            'name' => 'Test Item',
            'brand_id' => 1,
            'price' => 1000,
            'description' => 'This is a test item',
            'color_id' => 1,
            'category_id' => 1,
            'child_category_id' => 1,
            'grandchild_category_id' => 1,
            'condition_id' => 1,
        ]);

        // リダイレクトを確認
        $response->assertRedirect();
        $response->assertSessionHas('success', '商品が出品されました!');

        // アイテムがデータベースに存在することを確認
        $this->assertDatabaseHas('items', [
            'name' => 'Test Item',
            'user_id' => $user->id,
        ]);
    }
}
