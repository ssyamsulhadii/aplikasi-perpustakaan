<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $guarded = [];

    protected $dates = ['tanggal_pinjam', 'tanggal_kembali'];
    protected $with = ['user', 'buku'];

    // Relationship
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }
    // Invers Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }


    // Motator
    public function setKodeAttribute($value)
    {
        $this->attributes['kode'] = "PMJ-" . $value;
    }

    // Accessor
    public function getStringStatusAttribute()
    {
        return $this->attributes['status'] = 0 ? 'dipinjam' : 'dikembalikan';
    }
}
