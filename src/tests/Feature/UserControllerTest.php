<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_can_mypage()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('mypage'));
        $response->assertStatus(200);
    }
}
