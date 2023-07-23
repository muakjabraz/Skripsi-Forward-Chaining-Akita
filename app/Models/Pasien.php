<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'nama',
        'umur',
        'phone',
    ];

    public function kasus()
    {
        return $this->hasMany(Kasus::class);
    }
}
