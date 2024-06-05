<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Condition;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Condition::create([
            'name' => '新品、未使用',
        ]);
        Condition::create([
            'name' => '未使用に近い',
        ]);
        Condition::create([
            'name' => '目立った傷や汚れなし',
        ]);
        Condition::create([
            'name' => 'やや傷や汚れあり',
        ]);
        Condition::create([
            'name' => '傷や汚れあり',
        ]);
        Condition::create([
            'name' => '全体的に状態が悪い',
        ]);
    }
}
