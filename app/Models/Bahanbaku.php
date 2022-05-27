<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahanbaku extends Model
{
    use HasFactory;
    protected $fillable = [
        'kd_bahan',
        'nama_bahan',
        'satuan',
        'harga',
    ];

    public function hpp()
    {
        return $this->hasMany(Hpp::class);
    }
    
}
