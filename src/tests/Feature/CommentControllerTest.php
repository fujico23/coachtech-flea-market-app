<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Comment;
use App\Models\DefaultComment;

class CommentControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    use WithFaker;

    public function test_can_comment_store()
    {
        $user = User::factory()->create();
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);
        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($user)->post(route('comment.store', $item));
        $response->assertStatus(302);
        $response->assertRedirect();

        Comment::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'Test Comment',
        ]);
    }

    public function test_can_comment_delete()
    {
        $user = User::factory()->create();
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);
        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);
        $comment = Comment::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'Test Comment',
        ]);

        $response = $this->actingAs($user)->delete(route('comment.destroy', $comment));
        $response->assertStatus(302);
        $response->assertRedirect();

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);
    }

    public function test_can_defaultComment_add()
    {
        $user = User::factory()->create();
        $title = $this->faker->sentence;
        $comment = $this->faker->paragraph;

        $response = $this->actingAs($user)->post(route('defaultComment.add'), [
            'title' => $title,
            'comment' => $comment,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect();
        $response->assertSessionHas('success', 'あなた専用のコメントが追加されました!');

        $this->assertDatabaseHas('default_comments', [
            'user_id' => $user->id,
            'title' => $title,
            'comment' => $comment,
        ]);
    }

    public function test_can_defaultComment_update()
    {
        $user = User::factory()->create();
        $title = $this->faker->sentence;
        $comment = $this->faker->paragraph;

        $defaultComment = DefaultComment::create([
            'user_id' => $user->id,
            'title' => $title,
            'comment' => $comment,
        ]);

        $response = $this->actingAs($user)->post(route('defaultComment.update', $defaultComment), [
            'title' => 'Update Title',
            'comment' => 'Update Comment',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect();
        $response->assertSessionHas('success', 'あなた専用のコメントが更新されました!');

        $this->assertDatabaseHas('default_comments', [
            'user_id' => $user->id,
            'title' => 'Update Title',
            'comment' => 'Update Comment',
        ]);
    }
}
