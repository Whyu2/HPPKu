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
        'btkl_id',
        'bop1_id',
        'bop2_id',
        'besaran_btkl',
        'besaran_bop1',
        'besaran_bop2',
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
    public function totalgarnitur ($id_hpp = null)
    {
         $m = Hpp::where('makanan_id',$id_hpp)->first();
       
            $besaran_garnitur = $m->besaran_bop1;
            $result =($besaran_garnitur/100)*$m->total_bahan;
            return $result;
    }
    //menghitung total sales price
    public function totalsales ($id_hpp = null)
    {
         $m = Hpp::where('makanan_id',$id_hpp)->first();
       //cari total garnitur
         $besaran_garnitur = $m->besaran_bop1;
         $totalgranitures =($besaran_garnitur/100)*$m->total_bahan;
        //hitung sales price
         $besaran_sales = $m->besaran_bop2;
         $cost_perportion = $m->total_bahan + $totalgranitures;
         $result = ($besaran_sales/100) * $cost_perportion;
        return $result;
    }

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
