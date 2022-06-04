<?php

namespace App\Models;

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
    //menghitung jumlah totalHPP
    public function totalhpp ($id_eveent = null)
    {
         $m = Eveent_makanan::where('eveent_id',$id_eveent)->get();
           //ambil array qty
           foreach ($m as $q) {
            $qty[] = $q->qty;
            };

        //ambil array bahanbaku

     foreach ($m as $p) {
                $hpp[] = $p->hpp->total_hpp ;  
                };
            // ambil array hpp
            foreach ($m as $p) {
                $hpp[] = $p->hpp->total_hpp ;  
                };
         //ambil array hpp * qty
                $hpp_qty = [];
                foreach($qty as $i=>$val){
                array_push($hpp_qty, $qty[$i] * $hpp[$i]);
                }
                // hitung total hpp
                $result =   array_sum($hpp_qty);
                return $result;
    }
        //menghitung jumlah jual*QTY
    public function totalqtyjual ($id_eveent = null)
    {
         $m = Eveent_makanan::where('eveent_id',$id_eveent)->get();
         
             //ambil array qty
             foreach ($m as $q) {
                $qty[] = $q->qty;
                };
            //ambil array harga jual 
                foreach ($m as $p) {
                    $jual[] = $p->hpp->h_jual ;  
                    };
                //hitung total harga jual * qty
               $jual_qty = [];
               foreach($qty as $i=>$val){
               array_push($jual_qty, $qty[$i] * $jual[$i]);
               }
                $result =   array_sum($jual_qty);
                return $result;
    }

    
}

