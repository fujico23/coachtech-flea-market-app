<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

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
}
