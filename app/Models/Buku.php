<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $with = ['kategori'];
    protected $fillable = ['kategori_id', 'judul', 'sampul', 'penulis', 'penerbit', 'jumlah', 'dibaca'];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function getSampulUrlAttribute()
    {
        $nama_file = $this->sampul == null ? 'default.jpg' : $this->sampul;
        return asset('assets/images/sampul/' . $nama_file);
    }
}
