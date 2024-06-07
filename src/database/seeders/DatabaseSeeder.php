<?php

namespace Database\Seeders;

use App\Models\DefaultComment;
use Illuminate\Database\Seeder;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BrandsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(ConditionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        Item::factory(30)->create();
        $this->call(DefaultCommentsTableSeeder::class);
    }
}
