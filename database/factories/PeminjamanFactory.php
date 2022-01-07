<?php

namespace Database\Factories;

use DateInterval;
use DateTime;
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
        $tanggal = $this->faker->dateTimeBetween('2021-01-01', now());
        $tanggal_pinjam = new \Carbon\Carbon($tanggal);
        return [
            'kode' => $this->faker->bothify('###'),
            'anggota_id' => $this->faker->numberBetween(1, \App\Models\Anggota::count()),
            'buku_id' => $this->faker->numberBetween(1, \App\Models\Buku::count()),
            'tanggal_pinjam' => $tanggal_pinjam->isoFormat('YYYY-MM-DD'),
            'tanggal_kembali' => $tanggal_pinjam->addDay(3)->isoFormat('YYYY-MM-DD'),
            'jumlah_pinjam' => rand(1, 3),
            'status' => 1
        ];
    }
}
