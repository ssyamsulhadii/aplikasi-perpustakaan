<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $daftar_kategori = ['Web Programming', 'Pendiikan Agama', 'Peternakan & Perikanan', 'Kebudayaan', 'Penddikan Kewarganegaraan', 'Fotografi', 'Moblie Aplication', 'Astronomi', 'Geografi', 'Sain', 'Fisika', 'Kimia'];
        $kategori_yg_dipiih = $this->faker->unique()->randomElement($daftar_kategori);
        return [
            'nama' => $kategori_yg_dipiih,
            'rak_id' => $this->faker->numberBetween(1, \App\Models\Rak::count()),
        ];
    }
}
