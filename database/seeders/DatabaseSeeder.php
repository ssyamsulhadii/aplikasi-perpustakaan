<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\PeminjamanBuku;
use App\Models\Pengembalian;
use App\Models\PengembalianBuku;
use App\Models\Rak;
use App\Models\User;
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
        User::factory(5)->create();
        Rak::factory(6)->create();
        Kategori::factory(8)->create();
        $this->call(BukuSeeder::class);

        // membuat data anggota
        $user = User::where('level', 'anggota')->get();
        $user->map(fn ($user) => Anggota::create(['user_id' => $user->id]));

        Peminjaman::factory(100)->create();

        $peminjamanbuku_ = Peminjaman::all();
        foreach ($peminjamanbuku_ as $peminjamanbuku) {
            Pengembalian::create([
                'kode' => substr($peminjamanbuku->kode, 4, 3),
                'peminjaman_id' => $peminjamanbuku->id,
                'tanggal_kembali' => $peminjamanbuku->tanggal_kembali,
            ]);
        }
    }
}
