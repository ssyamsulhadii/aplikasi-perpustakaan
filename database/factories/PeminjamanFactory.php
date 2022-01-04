<?php

namespace Database\Factories;

use DateInterval;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode' => $this->faker->bothify('###'),
            'anggota_id' => $this->faker->numberBetween(1, \App\Models\Anggota::count()),
            'buku_id' => $this->faker->numberBetween(1, \App\Models\Buku::count()),
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => now()->add(new DateInterval('P3D')),
            'jumlah_pinjam' => rand(1, 3),
        ];
    }
}
