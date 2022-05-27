<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Kategori extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_kategori','created_at'
    ];
    
    // public function makanan()
    // {
    //     return $this->hasMany(Makanan::class);
    // }

    public function kategoriku()
    {
        $result = Kategori::all();
        return $result;
    }
   
}
