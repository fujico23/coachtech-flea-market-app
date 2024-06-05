<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create([
            'name' => 'ブラック系',
        ]);
        Color::create([
            'name' => 'グリーン系',
        ]);
        Color::create([
            'name' => 'イエロー系',
        ]);
        Color::create([
            'name' => 'オレンジ系',
        ]);
        Color::create([
            'name' => 'ホワイト系',
        ]);
        Color::create([
            'name' => 'グレイ系',
        ]);
        Color::create([
            'name' => 'ブラウン系',
        ]);
        Color::create([
            'name' => 'レッド系',
        ]);
        Color::create([
            'name' => 'ピンク系',
        ]);
        Color::create([
            'name' => 'パープル系',
        ]);
        Color::create([
            'name' => 'ブルー系',
        ]);
        Color::create([
            'name' => 'ベージュ系',
        ]);
    }
}
