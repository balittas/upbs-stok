<?php

namespace Database\Factories;

use App\Models\DetailProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DetailProductFactory extends Factory
{
    protected $model = DetailProduct::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Str::random(16) . Carbon::now()->format('YmdHis'),
            'product_id' => Product::all()->random()->id,
            'asal' => $this->faker->city(),
            'panen' => $this->faker->year(),
            'kelas' => $this->faker->randomElement(['Dasar', 'Pokok']),
            'db' => $this->faker->numberBetween(70, 100),
            'sisa' => $this->faker->numberBetween(900, 1500),
            'produksi' => $this->faker->numberBetween(900, 1500),
            'masuk' => $this->faker->numberBetween(900, 1500),
            'keluar_komersial' => $this->faker->numberBetween(0, 150),
            'keluar_nonkomersial' => $this->faker->numberBetween(0, 150),
            'tahun' => $this->faker->year(),
            'bulan' => $this->faker->monthName(),
            'slug' => Str::slug($this->faker->text()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
