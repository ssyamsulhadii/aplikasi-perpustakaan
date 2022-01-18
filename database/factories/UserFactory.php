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
        $daftar_nama_pengguna = ['Hadi', 'Aisyah', 'Mawarda', $this->faker->name];
        $nama = $this->faker->unique()->randomElement($daftar_nama_pengguna);
        $kode_nomor = ['0815', '0887', '0812', '0831', '0831'];
        $email = str_replace(' ', '', strtolower($nama)) . '@gmail.com';
        switch ($nama) {
            case 'Hadi':
                $nama = 'sys hi';
                $level = 'admin';
                $email = 'admin@gmail.com';
                break;
            case 'Aisyah':
                $level = 'adminbuku';
                $email = 'adminbuku@gmail.com';
                break;
            case 'Mawarda':
                $level = 'admintransaksi';
                $email = 'admintransaksi@gmail.com';
                break;
            default:
                $level = 'anggota';
                break;
        }
        return [
            'nama' => $nama,
            'email' => $email,
            'level' => $level,
            'email_verified_at' => now(),
            'password' => bcrypt('1234'),
            'telpon' => $this->faker->randomElement($kode_nomor) . $this->faker->bothify('########'),
            'alamat' => $this->faker->city,
            'created_at' => $this->faker->dateTimeBetween('2021-01-01', '2021-12-31'),
            // 'telpon' => "",
            // 'alamat' => "",
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