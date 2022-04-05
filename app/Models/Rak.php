<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;
    protected $fillable = ['nama'];
    protected $table = 'rak';

    // Relationship
    public function kategori_()
    {
        return $this->hasMany(Kategori::class);
    }
}
