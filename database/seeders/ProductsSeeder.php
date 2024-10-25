<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        // Очищаем таблицу products перед заполнением
        DB::table('products')->truncate();

        // Создаем 10 новых продуктов с помощью фабрики
        Product::factory(10)->create();
    }
}

// php artisan db:seed --class=ProductsSeeder - заполнение данными
