<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\DetailProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // User::factory(15)->create();
        // ProductCategory::factory(15)->create();
        // Product::factory(15)->create();
        // DetailProduct::factory(15)->create();
        // Transaction::factory(15)->create();
        // Cart::factory(15)->create();
        $this->call(LocationsSeeder::class);
    }
}
