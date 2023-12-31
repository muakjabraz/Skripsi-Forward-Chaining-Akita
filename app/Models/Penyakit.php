<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'definisi',
        'solusi',
    ];
    public function kasus()
    {
        return $this->hasMany(Kasus::class);
    }
}
