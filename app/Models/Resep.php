<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;
    protected $fillable = [
        'makanan_id',
        'bahan_id',
        'qty'
    ];

    public function makanan()
    {
        return $this->belongsTo(Makanan::class);
    }
    public function bahan()
    {
        return $this->belongsTo(Bahanbaku::class);
    }
    //menghitung total bahan
    public function totalbahan ($id_makanan = null)
    {
        $m = Resep::where('makanan_id',$id_makanan)->get();
            //ambil array qty
                  // array untuk harga bahan 
        foreach ($m as $p) {
            $harga[] = $p->bahan->harga ;  
       };
       //mencari total harga bahan
       $result =   array_sum($harga);
       return $result;
    }

    public function listbahan($id_hpp = null){
        $result = Resep::where('makanan_id',$id_hpp)->get();
        return $result;
    }
  

}
