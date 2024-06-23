<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::create([
            'name' => 'pending',
            'description' => '保留',
        ]);
        OrderStatus::create([
            'name' => 'unpaid',
            'description' => '注文済みだが未払い',
        ]);
        OrderStatus::create([
            'name' => 'paid',
            'description' => '注文し支払い済み',
        ]);
        OrderStatus::create([
            'name' => 'shipped',
            'description' => '購入者へ出荷済み',
        ]);
        OrderStatus::create([
            'name' => 'completed',
            'description' => '購入者受け取り完了',
        ]);
        OrderStatus::create([
            'name' => 'cancelled',
            'description' => '購入をキャンセル',
        ]);
    }
}
