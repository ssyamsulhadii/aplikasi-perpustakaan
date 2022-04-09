<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $result = [
            ['Admin', 1],
            ['Admin Buku', 2],
            ['Admin Transaksi', 3],
            ['Anggota', 4],
            ['Anggeline', 4],
        ];
        foreach ($result as $key => $value) {
            User::create([
                'nama' => $value[0],
                'email' => Str::of($value[0])->replace(' ', '')->lower() . "@gmail.com",
                'level_id' => $value[1],
                'email_verified_at' => now(),
                'password' => bcrypt('1234'),
                'telpon' => "08" . $faker->bothify('##########'),
                'alamat' => $faker->city,
            ]);
            if ($key == 4) {
                for ($i = 0; $i < 10; $i++) {
                    $nama = $faker->firstName . " " . $faker->lastName;
                    User::create([
                        'nama' => $nama,
                        'email' => Str::of($nama)->replace(' ', '')->lower() . "@gmail.com",
                        'level_id' => $value[1],
                        'email_verified_at' => now(),
                        'password' => bcrypt('1234'),
                        'telpon' => "08" . $faker->bothify('##########'),
                        'alamat' => $faker->city,
                    ]);
                }
            }
        }
    }
}
