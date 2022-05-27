<?php

namespace App\Models;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Eveent extends Model
{
    use HasFactory;
    protected $fillable = [
        'kd_event',
        'waktu_id',
        'nama_event',
        'total_porsi',
        'total_produksi',
        'total_jual',
        'tgl_mulai',
        'tgl_selesai',
    ];
    public function waktu()
    {
        return $this->belongsTo(Waktu::class);
    }

   public function lamaevent($tgl_mulai = null,$tgl_selesai = null) {
        $datetime1 = new DateTime($tgl_mulai);
        $datetime2 = new DateTime($tgl_selesai);
        $interval = $datetime1->diff($datetime2);
        $result = $interval->format('%a');
        return $result;
   }

   public function grost($total_jual = null , $total_produksi = null){
        $result = $total_jual - $total_produksi;
        return $result;
   }

   public function selectdate ($mulai = null, $sampai = null){

    if($mulai== null){
        $result = Eveent::all();
        return $result;
    }
    if($mulai==$mulai){
    $result = Eveent::where('tgl_mulai', '>=',$mulai)
    ->where('tgl_selesai', '<=',$sampai)
    ->get();
    return $result;
    }
   }
}
