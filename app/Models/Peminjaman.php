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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
    public function pengembalian_()
    {
        return $this->hasMany(Pengembalian::class);
    }


    public function setKodeAttribute($value)
    {
        $this->attributes['kode'] = "PMJ-" . $value;
    }

    public function getStringStatusAttribute()
    {
        return $this->attributes['status'] = 0 ? 'dipinjam' : 'dikembalikan';
    }
}
