<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $penerbit = ['PT Balai Pustaka', 'PT Gramedia Pustaka Utama', 'Kepustakaan Populer Gramedia', 'PT Bentang Pustaka', 'Yayasan Pustaka Obor Indonesia', 'PT Grasindo'];
        $buku = $this->faker->sentence(3);
        return [
            'judul' => $buku,
            'penulis' => $this->faker->name(),
            'penerbit' => $this->faker->randomElement($penerbit),
            'jumlah' => $this->faker->numberBetween(5, 8),
            'dibaca' => $this->faker->numberBetween(0, 25),
            'kategori_id' => $this->faker->numberBetween(1, \App\Models\Kategori::count()),
        ];
    }
}
