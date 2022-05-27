<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Bahanbaku;
use App\Models\Makanan;
use App\Models\Resep;
use App\Models\Hpp;
use App\Models\Eveent;
use App\Models\Eveent_makanan;
use BahanBaku as GlobalBahanBaku;
use DateTime;

class DasrbordController extends Controller
{
    public function __construct()
    {
        $this->hpp = new HPP();
        $this->eveent_makanan = new Eveent_makanan();
        $this->eveent = new Eveent();
    }
    public function homeuser()
    {
        $k = Kategori::paginate(4);
        $b = Bahanbaku::paginate(4);
        $m = Makanan::paginate(4);
        $h = Hpp::paginate(4);
        $e = Eveent::paginate(4);
        $ka = Kategori::count();
        $ba = Bahanbaku::count();
        $ma = Makanan::count();
        $ea = Eveent::count();
        $ha = Resep::distinct()->get('makanan_id')->count();


        //menampilkan lama nama even dan lama event
     
             //  $tabel['tgl_mulai']=$datas->tgl_mulai;
            //  $tabel['tgl_selesai']=$datas->tgl_selesai;\
        $data = [
            'title' => 'Home | Dashbord',
            'kategori' => $k,
            'jumlahk' => $ka,
            'jumlahb' => $ba,
            'bahan' => $b,
            'makanan' => $m,
            'hpp' => $h,
            'jumlahm' => $ma,
            'jumlahh' => $ha,
            'event' => $e,
            'events' =>  $this->eveent,
            'jumlahe' => $ea,
     
        ];
    
        return view('home.dashbord.home', $data);
    }
    public function about()
    {
        $data = [
            'title' => 'About',
          
        ];
        return view('home.about.home', $data);
    }
    
}
