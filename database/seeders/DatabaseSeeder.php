<?php

namespace Database\Seeders;

use App\Models\Rak;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LevelSeeder::class);
        $this->call(UserSeeder::class);
        for ($i = 1; $i <= 8; $i++) {
            Rak::create([
                'nama' => 'Rak ' . $i,
            ]);
        }
        Kategori::factory(8)->create();
        Buku::factory(20)->create();
        Peminjaman::factory(50)->create();
        $peminjamanbuku_ = Peminjaman::all();
        foreach ($peminjamanbuku_ as $peminjamanbuku) {
            if ($peminjamanbuku->id < 25) {
                $tanggal_kembali_over = null;
                $denda = null;
            } else {
                $tanggal_kembali_over = $peminjamanbuku->tanggal_kembali->addDay(2);
                $denda = 12000;
            }
            Pengembalian::create([
                'kode' => substr($peminjamanbuku->kode, 4, 3),
                'peminjaman_id' => $peminjamanbuku->id,
                'tanggal_kembali' => $peminjamanbuku->tanggal_kembali,
                'tanggal_kembali_over' => $tanggal_kembali_over,
                'denda' => $denda,
            ]);
        }
    }
}
