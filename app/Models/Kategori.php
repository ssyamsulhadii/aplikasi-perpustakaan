<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = ['nama', 'rak_id'];

    protected $with = ['rak'];

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }
    public function buku_()
    {
        return $this->hasMany(Buku::class);
    }
}
