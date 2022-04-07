<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $table = 'level';
    protected $guarded = [];

    // Relationship
    public function user_()
    {
        return $this->hasMany(User::class);
    }

    // accessor
    public function getNamaAttribute($value)
    {
        return ucfirst($value);
    }
}
