<?php

use App\Http\Livewire\Admin\Pengguna;
use App\Http\Livewire\Anggota\ListAnggota;
use App\Http\Livewire\Beranda\ListBuku;
use App\Http\Livewire\Bukusaya\ListBukuSaya;
use App\Http\Livewire\Peminjamanbuku\ListPeminjamanBuku;
use App\Http\Livewire\Pengembalianbuku\ListPengembalianBuku;
use App\Http\Livewire\Pengguna\GantiPassword;
use App\Http\Livewire\Pengguna\Profil;
use App\Http\Livewire\TambahData\Buku as TambahDataBuku;
use App\Http\Livewire\TambahData\Kategori as TambahDataKategori;
use App\Http\Livewire\TambahData\Rak as TambahDataRak;
use Illuminate\Support\Facades\Route;


// Route::get('/', fn () => view('blank-page'))->middleware(['auth', 'verified']);

Route::get('/', ListBuku::class);
Route::get('list-buku', ListBuku::class)->prefix('beranda')->name('list-buku');

Route::middleware(['auth'])->group(function () {

    Route::get('list-buku-saya', ListBukuSaya::class)->name('list-buku-saya');
    Route::get('profil', Profil::class)->prefix('umum')->name('umum.profil');
    Route::get('ganti-password', GantiPassword::class)->prefix('umum')->name('umum.ganti-password');

    Route::get('pengguna', Pengguna::class)->name('pengguna')->middleware('IsAdmin');

    Route::get('rak', TambahDataRak::class)->prefix('tambah-data')->name('tambah-data.rak')->middleware('admin.AdminBuku');
    Route::get('kategori', TambahDataKategori::class)->prefix('tambah-data')->name('tambah-data.kategori')->middleware('admin.AdminBuku');
    Route::get('buku', TambahDataBuku::class)->prefix('tambah-data')->name('tambah-data.buku')->middleware('admin.AdminBuku');

    Route::get('anggota', ListAnggota::class)->name('anggota')->middleware('admin.AdminTransaksi');
    Route::get('peminjaman-buku', ListPeminjamanBuku::class)->name('peminjaman-buku')->middleware('admin.AdminTransaksi');
    Route::get('pengembalian-buku', ListPengembalianBuku::class)->name('pengembalian-buku')->middleware('admin.AdminTransaksi');
});
