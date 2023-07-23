<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aturan extends Model
{
    use HasFactory;

    protected $fillable = [
        'gejala_id',
        'kasus_id',
    ];

    public function gejala()
    {
        return $this->belongsTo(Gejala::class);
    }
    public function kasus()
    {
        return $this->belongsTo(Kasus::class);
    }
}
