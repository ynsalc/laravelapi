<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        //DB::table('categories')->truncate();
        Category::truncate();

        Category::factory(10)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
