<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    protected $fillable = ['nama'];
    use HasFactory;
    protected $table = 'rak';

    public function kategori_()
    {
        return $this->hasMany(Kategori::class);
    }
}
