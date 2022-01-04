<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    protected $guarded = [];
    protected $dates = ['tanggal_kembali', 'tanggal_kembali_over'];

    public function setKodeAttribute($value)
    {
        $this->attributes['kode'] = "PGN-" . $value;
    }
}
