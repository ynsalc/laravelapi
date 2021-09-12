<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategories;
use Illuminate\Support\Facades\DB;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        ProductCategories::create(['product_id'=>1, 'category_id'=>1]);
        ProductCategories::create(['product_id'=>1, 'category_id'=>2]);
        ProductCategories::create(['product_id'=>2, 'category_id'=>1]);
        ProductCategories::create(['product_id'=>2, 'category_id'=>2]);
        ProductCategories::create(['product_id'=>2, 'category_id'=>3]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
