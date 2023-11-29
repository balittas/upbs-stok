<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 'transaction-' . Str::random(3) . '-' . Carbon::now()->format('YmdHis'),
            'user_id' => User::all()->random()->id,
            'paid_total' => $this->faker->numberBetween(3000, 40000),
            'status' => $this->faker->randomElement(['Pending', 'Process', 'Complete', 'Cancel']),
            'alamat' => $this->faker->address(),
            'zip_code' => $this->faker->countryCode(),
            'kabupaten_kota' => $this->faker->city(),
            'provinsi' => $this->faker->city(),
            'no_hp' => $this->faker->phoneNumber(),
            'nama_penerima' => $this->faker->name(),
            'bukti_transfer_produk' => $this->faker->imageUrl($width = 640, $height = 640),
            'bukti_transfer_ongkir' => $this->faker->imageUrl($width = 640, $height = 640),
            'total_produk' => $this->faker->numberBetween(900, 1500),
            'total_ongkir' => $this->faker->numberBetween(3000, 40000),
            'order_notes' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
