<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\DetailProduct;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CartFactory extends Factory
{
    protected $model = Cart::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Str::random(16) . Carbon::now()->format('YmdHis'),
            'user_id' => User::all()->random()->id,
            'detail_product_id' => DetailProduct::all()->random()->id,
            'transaction_id' => Transaction::all()->random()->id,
            'qty' => $this->faker->numberBetween(10, 100),
            'status' => $this->faker->randomElement(['Pending', 'Process', 'Complete', 'Cancel']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
