<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $fillable = ['user_id'];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function peminjaman_()
    {
        return $this->hasMany(Peminjaman::class);
    }
    public function pengembalian_()
    {
        return $this->hasManyThrough(Pengembalian::class, Peminjaman::class);
    }
}