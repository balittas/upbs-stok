<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Str::random(16) . Carbon::now()->format('YmdHis'),
            'category_id' => ProductCategory::all()->random()->id,
            'name' => $this->faker->text(),
            'image' => $this->faker->imageUrl($width = 640, $height = 640),
            'description' => $this->faker->text(),
            'unit' => $this->faker->randomElement(['pcs', 'gram', 'kg']),
            'price' => $this->faker->numberBetween(3000, 40000),
            'slug' => Str::slug($this->faker->text()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
