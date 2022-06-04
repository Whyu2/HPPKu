<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makanan;
use App\Models\Bahanbaku;
use App\Models\Resep;
use App\Models\Bop;
use App\Models\Btkl;
use App\Models\Hpp;
use App\Models\Cost;
use Carbon\Carbon;
use League\CommonMark\Extension\Table\Table;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;

class HppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->hpp = new HPP();
        $this->resep = new Resep();
    }

    public function home()
    {
       
        $m = Makanan::whereNull('hpp')->get();
        $b = Bahanbaku::all();
        $l = Hpp::all();
        $d = Carbon::now()->format('Y-m-d H:i:s');
        // $l= DB::table('reseps')->select('makanan_id')->distinct()->get();
  
        $data = [
            'title' => 'HPP Permakanan',
            'makanan' => $m,
            'bahan' => $b,
            'list' => $l,
            'date'=> $d,
        ];


        return view('home.user.hpp_makanan_tambah', $data);
      
    }
    public function detail($id)
    {
       
        $makanan_detail = Makanan::find($id); 
        //mengambil banyak resep data untuk menampilan data sesuai makanan yang dipilih
        $resep_detail = Resep::where('makanan_id',$id)->get();
        //mengambil data detail HPP
        $hpp_detail = Hpp::where('makanan_id',$id)->first();
        //mengambil 1 data untuk patokan bahanbaku periode
        $perioderesep = Resep::where('makanan_id',$id)->first();
        
        //mengambil data BOP
        $bop = Bop::where('id',1)->first();
        //mengambil data BTKL
        $btkl = Btkl::where('id',1)->first();
        //mengambil data cost
        $cost = Cost::where('id',1)->first();
    
        $data = [
            'title' => 'Detail Makanan',
            'makanan_detail' => $makanan_detail,
            'hpp_detail' => $hpp_detail,
            'bahan_makanan' => $resep_detail,
            'perioderesep' => $perioderesep,
            'btkl' => $btkl,
            'bop' => $bop,
            'cost' => $cost,
            'resep' => $this->resep,
            'hpp' =>  $this->hpp
        ];
        return view('home.user.hpp_makanan_detail', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //mengambil data dari form
        
        $request->validate([
            'kd_makanan' => 'required',
            'qty.*'  => 'required|numeric'
        ]);
        $kd_bahan = $request->kd_bahan;
        $qty = $request->qty;
        $kd_makanan = $request->kd_makanan;
        $date= Carbon::now()->format('Y-m-d H:i:s');
        //looping untuk memasukkan data dalam array
        for ($i=0; $i<count($kd_bahan); $i++){
                $save = [
                'bahan_id' => $kd_bahan[$i],
                'makanan_id' => $kd_makanan,
                'qty' => $qty[$i],
                'created_at' => $date
            ];
            DB::table('reseps')->insert($save);
        }

        //mengambil data bahan berdasarkan resep untuk menghitung bahan
        $res = Resep::where('makanan_id',$kd_makanan)->get();
        //mengambil data BOP granitur
        $bop = Bop::where('id',1)->first();
        //mengambil data BTKL
        $btkl = Btkl::where('id',1)->first();
        //mengambil data cost
        $cost = Cost::where('id',1)->first();
        //mengambil array untuk mengambil data harga 
        foreach ($res as $p) {
             $harga[] = $p->bahan->harga ;  
        };
        //BahanBaku(harga satuan bahan * qty)
        $totalbahanqty = 0;
        foreach($harga AS $k=>$v){
          $totalbahanqty += $v*$qty[$k];
        }
        //BTKL 
        $totalbtkl = $btkl->besaran;
        //BOP GARNITURES & OTHER 
        $besaran_bop = $bop->besaran;
        $totalbop =($besaran_bop/100)*$totalbahanqty;
        //total hpp
        $total_hpp = $totalbahanqty + $totalbtkl + $totalbop;
        //Cost Percentace sales Price
        $besaran_cost = $cost->besaran;
        $h_jual = ($total_hpp/$besaran_cost)*100;
        $h_jual_final = $h_jual*1.21;
      
        $hpp = Hpp::create([
            'makanan_id' => $kd_makanan,
            'besaran_btkl' => $btkl->besaran,
            'besaran_bop' => $bop->besaran,
            'besaran_cost' => $cost->besaran,
            'total_bahan' => $totalbahanqty,
            'total_btkl' => $totalbtkl,
            'total_bop' => $totalbop,
            'total_hpp' => $total_hpp,
            'h_jual' => $h_jual_final,
            'created_at' => $date
    ]);
    //update status untuk makanan yang sudah di input hppnya
        $makanan = Makanan::whereId($kd_makanan)->first();
        $makanan->update([
            'hpp' => 'Y'
    ]);

        return redirect('/hpp')->with('sukses', 'Data HPP , Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {

    //     $makanan = Makanan::whereId($id)->first();
    //     $makanan->update([
    //         'hpp' => null
    //     ]);

    //     $res=Resep::where('makanan_id',$id)->delete();

    //     return redirect('/hpp')->with('hapus', 'Data HPP berhasil dihapus!');
    // }

    // public function  resep(Request $request)
    // {
    //     $kd_bahan = $request->kd_bahan;
    //     $kd_makanan = $request->kd_makanan;
    // }


    public function destroy(Request $request)
    {
        $id= $request->input('delete_hpp');
        $makanan = Makanan::whereId($id)->first();
        $makanan->update([
            'hpp' => null
        ]);

        $res=Resep::where('makanan_id',$id)->delete();
        $hpp=Hpp::where('makanan_id',$id)->delete();
            return redirect('/hpp')->with('hapus', 'Data HPP berhasil dihapus!');
    }

    public function cetak_hppmakanan($id)
    {
    
        $makanan_detail = Makanan::find($id); 
        //mengambil banyak resep data untuk menampilan data sesuai makanan yang dipilih
        $resep_detail = Resep::where('makanan_id',$id)->get();
        //mengambil data detail HPP
        $hpp_detail = Hpp::where('makanan_id',$id)->first();
        //mengambil 1 data untuk patokan bahanbaku periode
        $perioderesep = Resep::where('makanan_id',$id)->first();
        
        //mengambil data BOP
        $bop = Bop::where('id',1)->first();
        //mengambil data BTKL
        $btkl = Btkl::where('id',1)->first();
        //mengambil data cost
        $cost = Cost::where('id',1)->first();
    
        $data = [
            'title' => 'Detail Makanan',
            'makanan_detail' => $makanan_detail,
            'hpp_detail' => $hpp_detail,
            'bahan_makanan' => $resep_detail,
            'perioderesep' => $perioderesep,
            'btkl' => $btkl,
            'bop' => $bop,
            'cost' => $cost,
            'resep' => $this->resep,
            'hpp' =>  $this->hpp
        ];

  
        return view('cetak.cetak_hppmakanan', $data);
      
    }

    public function cetak_hppmakanan_pdf($id)
    {
        $makanan_detail = Makanan::find($id); 
        //mengambil banyak resep data untuk menampilan data sesuai makanan yang dipilih
        $resep_detail = Resep::where('makanan_id',$id)->get();
        //mengambil data detail HPP
        $hpp_detail = Hpp::where('makanan_id',$id)->first();
        //mengambil 1 data untuk patokan bahanbaku periode
        $perioderesep = Resep::where('makanan_id',$id)->first();
        
        //mengambil data BOP
        $bop = Bop::where('id',1)->first();
        //mengambil data BTKL
        $btkl = Btkl::where('id',1)->first();
        //mengambil data cost
        $cost = Cost::where('id',1)->first();
    
        $data = [
            'title' => 'Detail Makanan',
            'makanan_detail' => $makanan_detail,
            'hpp_detail' => $hpp_detail,
            'bahan_makanan' => $resep_detail,
            'perioderesep' => $perioderesep,
            'btkl' => $btkl,
            'bop' => $bop,
            'cost' => $cost,
            'resep' => $this->resep,
            'hpp' =>  $this->hpp
        ];

  
        // instantiate and use the dompdf class

        $html = PDF::LoadView('cetak.cetak_hppmakanan_pdf', $data);
       
        $html->setPaper('A4', 'potrait');

   
        return $html->stream('Hpp.pdf');
    }
    
    
    
}
