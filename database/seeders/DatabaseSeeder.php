<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(15)->create();
        \App\Models\Rak::factory(8)->create();
        \App\Models\Kategori::factory(12)->create();
        $this->call(BukuSeeder::class);

        // membuat data anggota
        $user = \App\Models\User::where('level', 'anggota')->get();
        $user->map(fn ($user) => \App\Models\Anggota::create(['user_id' => $user->id]));
    }
}
