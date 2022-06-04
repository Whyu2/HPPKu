<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LDAP\Result;
use Illuminate\Support\Facades\DB;

class Hpp extends Model
{
    use HasFactory;
    protected $fillable = [
        'makanan_id',
        'besaran_btkl',
        'besaran_bop',
        'besaran_cost',
        'total_bahan',
        'total_btkl',
        'total_bop',
        'total_hpp',
        'h_jual'
    ];

    public function makanan()
    {
        return $this->belongsTo(Makanan::class);
    }
    public function bop()
    {
        return $this->belongsTo(Bop::class);
    }

    public function btkl()
    {
        return $this->belongsTo(Btkl::class);
    }
    //menghitung total granitures
    //menghitung total sales price
  

    //menghitung qty * harga bahan
    public function bahanqty ($qty = null, $h_bahan=null){
        $result = $h_bahan * $qty;
        return $result;
    }
    //pemilihan hpp makanan berdasarkan kategori
    public function selectkategori ($id_kategori = null)
    {
        if ($id_kategori == null){
            $result = Hpp::join('makanans', 'makanans.id', '=', 'hpps.makanan_id')
            ->join('kategoris', 'kategoris.id', '=', 'makanans.kategori_id')
            ->get(['makanans.*', 'hpps.total_hpp','kategoris.nama_kategori', 'hpps.h_jual'])->toArray();
     
        return $result;
        }
        if ($id_kategori == $id_kategori){
        $result = Hpp::join('makanans', 'makanans.id', '=', 'hpps.makanan_id')
        ->join('kategoris', 'kategoris.id', '=', 'makanans.kategori_id')
        ->where('makanans.kategori_id','=', $id_kategori)
        ->get(['makanans.*', 'hpps.total_hpp','kategoris.nama_kategori', 'hpps.h_jual'])->toArray();

        return $result;
        }

    }


}
