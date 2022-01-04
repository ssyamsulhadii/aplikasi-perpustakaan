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
    protected $with = ['anggota', 'buku'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
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
}
