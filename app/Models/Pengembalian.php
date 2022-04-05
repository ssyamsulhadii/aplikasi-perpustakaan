<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    protected $guarded = [];
    protected $dates = ['tanggal_kembali', 'tanggal_kembali_over'];
    protected $with = ['peminjaman'];

    // Relationship
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    // Motator
    public function setKodeAttribute($value)
    {
        $this->attributes['kode'] = "PGN-" . $value;
    }

    // Accessor
    public function getTanggal1Attribute()
    {
        if ($this->tanggal_kembali) {
            $tanggal = new Carbon($this->attributes['tanggal_kembali']);
            $tanggal = $tanggal->isoFormat('DD-MM-YYYY');
        } else {
            $tanggal = '-';
        }
        return $tanggal;
    }
    public function getTanggal2Attribute()
    {
        if ($this->tanggal_kembali_over) {
            $tanggal = new Carbon($this->attributes['tanggal_kembali_over']);
            $tanggal = $tanggal->isoFormat('DD-MM-YYYY');
        } else {
            $tanggal = '-';
        }
        return $tanggal;
    }

    public function getRupiahDendaAttribute()
    {
        if ($this->denda) {
            $denda = "Rp." . $this->denda;
        } else {
            $denda = "";
        }
        return $denda;
    }

    public function getFungsiAttribute()
    {
        if ($this->tanggal_kembali) {
            $fungsi = true;
        } else {
            $fungsi = false;
        }
        return $fungsi;
    }
}
