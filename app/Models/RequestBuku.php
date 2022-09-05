<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestBuku extends Model
{
    use HasFactory;
    protected $table = 'request_buku';
    protected $guarded = [];

    function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getSampulUrlAttribute()
    {
        $nama_file = $this->sampul == null ? 'default.jpg' : $this->sampul;
        return asset('storage/request-buku/' . $nama_file);
    }

    public function getStatusAttribute($value)
    {
        return $value ? 'Yes' : 'N/A';
    }
}
