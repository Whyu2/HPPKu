<?php

namespace App\Models;

use EveentMakanan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eveent_makanan extends Model
{
    use HasFactory;
    protected $fillable = [
    'eveent_id',
    'hpp_id',
    'qty',
    ];

    public function hpp()
    {
        return $this->belongsTo(Hpp::class);
    }
    //menghitung jumlah variasi memu di setiap event
    public function jumlahmenu ($id_eveent = null )
    {
        $result = Eveent_makanan::groupBy('eveent_id')
        ->selectRaw('count(DISTINCT hpp_id) as total')
        ->where(['eveent_id' => $id_eveent])
        ->first();
        return $result;
    }
    //menghitung jumlah qty
    public function totalqty ($id_eveent = null)
    {
         $m = Eveent_makanan::where('eveent_id',$id_eveent)->get();
            //ambil array qty
            foreach ($m as $q) {
                $qty[] = $q->qty;
                };
                //hitung total qty
                $result =   array_sum($qty);
                return $result;
    }
    //menghitung total bahan berdasarkan Qty
    public function total_qty ($id_bahan, $qty){
        $bahan = Resep::where('bahan_id', $id_bahan)->first();
        $qtyy_bahan = sprintf('%g',$bahan->qty); 
        $result = $qtyy_bahan * $qty ;
        return $result;
    }
    //menghitung jumlah totalHPP

        //menghitung jumlah jual*QTY
   
    //hitung total qty berdasarkan jumlah porsi
  

    
}

