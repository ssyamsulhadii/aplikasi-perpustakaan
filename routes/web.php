<?php

use App\Http\Livewire\Admin\Pengguna;
use App\Http\Livewire\Anggota\ListAnggota;
use App\Http\Livewire\Pengguna\GantiPassword;
use App\Http\Livewire\Pengguna\Profil;
use App\Http\Livewire\TambahData\Buku as TambahDataBuku;
use App\Http\Livewire\TambahData\Kategori as TambahDataKategori;
use App\Http\Livewire\TambahData\Rak as TambahDataRak;
use Illuminate\Support\Facades\Route;


// Route::get('/', fn () => view('blank-page'))->middleware(['auth', 'verified']);
Route::get('/', fn () => view('blank-page'))->middleware(['auth']);
Route::get('profil', Profil::class)->name('profil');
Route::get('ganti-password', GantiPassword::class)->name('ganti-password');
Route::get('pengguna', Pengguna::class)->name('pengguna');

Route::get('rak', TambahDataRak::class)->prefix('tambah-data')->name('tambah-data.rak');
Route::get('kategori', TambahDataKategori::class)->prefix('tambah-data')->name('tambah-data.kategori');
Route::get('buku', TambahDataBuku::class)->prefix('tambah-data')->name('tambah-data.buku');

Route::get('anggota', ListAnggota::class)->name('anggota');
