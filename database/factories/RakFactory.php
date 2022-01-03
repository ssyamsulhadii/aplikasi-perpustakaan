<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $daftar_rak = ['rak 1', 'rak 2', 'rak 3', 'rak 4', 'rak 5', 'rak 6', 'rak 7', 'rak 8'];
        $rak_yg_dipilih = $this->faker->unique()->randomElement($daftar_rak);
        return [
            'nama' => ucfirst($rak_yg_dipilih),
        ];
    }
}
