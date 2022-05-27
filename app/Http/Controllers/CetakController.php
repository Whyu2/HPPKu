<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hpp;
use App\Models\Eveent;
use App\Models\Eveent_makanan;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Empty_;
use PHPUnit\Framework\Constraint\IsEmpty;

class CetakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function __construct()
    {
        $this->hpp = new HPP();
        $this->event = new Eveent();
        $this->date= Carbon::now()->format('Y-m-d H:i:s');
    }
    public function home_cetak_hpp()
    {
     
        $h = $this->hpp->selectkategori();
        $kategori  = Kategori::all();
     
        $data = [
            'title' => 'Cetak HPP',
            'list' => $h,
            'kategori' => $kategori

        ];
   
        return view('home.user.cetak_hpp', $data);
    }
    public function home_cetak_hpp_select(Request $request)
    {


        $id= $request->input('id_kategori');
        $kategori  = Kategori::all();
        $h = $this->hpp->selectkategori($id);


        $data = [
            'title' => 'Cetak HPP',
            'list' => $h,
            'id_kategori'=> $id,
            'kategori' => $kategori
            // $nama_kategori = ;
        ];
   
        return view('home.user.cetak_hpp_selected', $data);
    }

    public function cetak_hpp()
    {

    $h = $this->hpp->selectkategori();
    $nama_kategori = "Semua Kategori";
        $kategori  = Kategori::all();
        $data = [
            'title' => 'Cetak HPP',
            'list' => $h,
            'kategori' => $kategori,
            'nama_kategori' => $nama_kategori,
            'date' =>  $this->date
    
        ];
   
        return view('cetak.cetak_hpp', $data);
    }

    public function cetak_hpp_select($id)
    {
   
    $h = $this->hpp->selectkategori($id);
    $k = Kategori::where('id',$id)->first();
    $kategori = $k->nama_kategori;
    
        $data = [
            'title' => 'Cetak HPP',
            'list' => $h,
            'nama_kategori' => $kategori,
            'date' =>  $this->date
         
    
        ];
   
        return view('cetak.cetak_hpp', $data);
  
    
      
    }
    public function home_cetak_event()
    {
     
        $h = $this->event->selectdate();
       
        $data = [
            'title' => 'Cetak Event',
            'list' => $h,
            'mulai'=> '',
            'selesai'=> '',
            'event' => $this->event
        ];
        // $result = Hpp::join('makanans', 'makanans.id', '=', 'hpps.makanan_id')
        //     ->join('kategoris', 'kategoris.id', '=', 'makanans.kategori_id')
        //     ->get(['makanans.*', 'hpps.total_hpp','kategoris.nama_kategori', 'hpps.h_jual'])->toArray();
        //  dd($result);
        return view('home.user.cetak_event', $data);
    }
    public function home_cetak_event_select(Request $request)
    {

    $mulai = formatawaltahun($request->tglmulai);
    $selesai = formatawaltahun($request->tglselesai);

        $h = $this->event->selectdate($mulai,$selesai);
       
        
        $mulai = 'kosong';
        $data = [
            'title' => 'Cetak Event',
            'list' => $h,
            'mulai'=> $request->tglmulai,
            'selesai'=> $request->tglselesai,
            'event' => $this->event
        ];
        // $result = Hpp::join('makanans', 'makanans.id', '=', 'hpps.makanan_id')
        //     ->join('kategoris', 'kategoris.id', '=', 'makanans.kategori_id')
        //     ->get(['makanans.*', 'hpps.total_hpp','kategoris.nama_kategori', 'hpps.h_jual'])->toArray();
        //  dd($result);
        return view('home.user.cetak_event', $data);
    }

    public function cetak_event()
    {

        $h = $this->event->selectdate();
       
        $data = [
            'title' => 'Cetak Event',
            'list' => $h,
            'mulai'=> '',
            'selesai'=> '',
            'event' => $this->event
        ];
   
        return view('cetak.cetak_event', $data);
    }
    public function print_select_event(Request $request)
    {

    $mulai = formatawaltahun($request->tglmulai);
    $selesai = formatawaltahun($request->tglselesai);

        $h = $this->event->selectdate($mulai,$selesai);
       
        
  
        $data = [
            'title' => 'Cetak Event',
            'list' => $h,
            'mulai'=> $request->tglmulai,
            'selesai'=> $request->tglselesai,
            'event' => $this->event
        ];
        // $result = Hpp::join('makanans', 'makanans.id', '=', 'hpps.makanan_id')
        //     ->join('kategoris', 'kategoris.id', '=', 'makanans.kategori_id')
        //     ->get(['makanans.*', 'hpps.total_hpp','kategoris.nama_kategori', 'hpps.h_jual'])->toArray();
        //  dd($result);
        return view('cetak.cetak_event', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
}
