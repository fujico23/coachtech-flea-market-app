<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\Category;

class ItemControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_can_index_item()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_can_detail_item()
    {
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);
        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);
        $response =
            $this->get(route('detail', ['item' => $item->id,]));
        $response->assertStatus(200);
    }
}
