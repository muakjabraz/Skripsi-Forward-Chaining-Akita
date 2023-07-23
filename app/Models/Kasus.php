<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasus extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasien_id',
        'user_id',
        'penyakit_id',
        'bobot',
        'type',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }
}
