<?php

namespace App\Models;

use App\Models\Peminjaman;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
// class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nama',
        'email',
        'level_id',
        'password',
        'alamat',
        'telpon',
        'gambar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship
    public function peminjaman_()
    {
        return $this->hasMany(Peminjaman::class);
    }
    // Invers Relationship
    public function level()
    {
        return $this->belongsTo(level::class);
    }

    // Accessor
    public function getStringLevelAttribute()
    {
        return ucfirst($this->level->nama);
    }
    public function getProfilGambarAttribute()
    {
        $nama_file = $this->gambar == null ? 'default.jpg' : $this->gambar;
        return asset('assets/images/profil/' . $nama_file);
    }

    // akses menu level admin
    public function getLevelAdminAttribute()
    {
        return $this->level_id == 1;
    }

    // akses menu level admin buku
    public function getLevelAdminBukuAttribute()
    {
        return $this->level_id == 1  || $this->level_id == 2;
    }

    // akses menu level admin transaksi
    public function getLevelAdminTransaksiAttribute()
    {
        return $this->level_id == 1  || $this->level_id == 3;
    }
}
