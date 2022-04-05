<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $kode_nomor = ['0815', '0887', '0812', '0831', '0831'];
        $level_ = \App\Models\Level::all();
        $nama_users = [
            ['Admin', 1],
            ['Admin Buku', 2],
            ['Admin Transaksi', 3],
            ['Anggota', 4],
            [$this->faker->name, 4]
        ];
        $nama = $this->faker->unique()->randomElement($nama_users);
        return [
            'nama' => $nama[0],
            'email' => Str::of($nama[0])->replace(' ', '')->lower() . "@gmail.com",
            'level_id' => $nama[1],
            'email_verified_at' => now(),
            'password' => bcrypt('1234'),
            'telpon' => $this->faker->randomElement($kode_nomor) . $this->faker->bothify('########'),
            'alamat' => $this->faker->city,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
