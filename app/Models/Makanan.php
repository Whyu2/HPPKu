<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
 
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kategori_id',
        'kd_makanan',
        'nama_makanan',
        'penyajian',
        'hpp'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hpp()
    {
        return $this->hasMany(Hpp::class);
    }
}
