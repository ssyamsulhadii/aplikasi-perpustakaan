<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $result = [
            ['nama' => 'admin', 'kode' => 'LVL-01'],
            ['nama' => 'admin buku', 'kode' => 'LVL-02'],
            ['nama' => 'admin transaksi', 'kode' => 'LVL-02'],
            ['nama' => 'anggota', 'kode' => 'LVL-03'],
        ];
        foreach ($result as $value) {
            Level::create([
                'nama' => $value['nama'],
                'kode' => $value['kode'],
            ]);
        }
    }
}
