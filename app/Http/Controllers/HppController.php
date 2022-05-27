<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makanan;
use App\Models\Bahanbaku;
use App\Models\Resep;
use App\Models\Bop;
use App\Models\Btkl;
use App\Models\Hpp;
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
        //mengambil banyak data untuk menampilan data sesuai makanan yang dipilih
        $resep_detail = Resep::where('makanan_id',$id)->get();
        //mengambil data detail HPP
        $hpp_detail = Hpp::where('makanan_id',$id)->first();
        //mengambil 1 data untuk patokan bahanbaku periode
        $perioderesep = Resep::where('makanan_id',$id)->first();
        //mengambil update data BOP BTKL untuk list manajemen
        $btkl = Btkl::where('id',1)->first();
        $bop = Bop::where('id',1)->first();
        $bop2 = Bop::where('id',2)->first();
        // array untuk harga bahan 
        // foreach ($resep_detail as $p) {
        //      $harga[] = $p->bahan->harga ;  
        // };

        // menampilkan perhitungan harga bahan baku * qty dalam array []
        // foreach ($resep_detail as $p) {
        //     $qty[] = $p->qty;
        // };
        // $bahanqty = [];
        // foreach($qty as $i=>$val){
        // array_push($bahanqty, $qty[$i] * $harga[$i]);
        // }

        //buat array untuk menggabungkan semua data untuk menampilkan kumpulan dari array 
        $results=array();
        foreach($resep_detail as $key=>$data)
         {
            $tabel=array();
            $tabel['nama_bahan']=$data->bahan->nama_bahan;
            $tabel['unit']=$data->bahan->satuan;
            $tabel['qty']=$data->qty;
            $tabel['price']=$data->bahan->harga;
            // $tabel['hargaqty']=$bahanqty[$key];
            $results[]=$tabel;
        }

        $data = [
            'title' => 'Detail Makanan',
            'makanan_detail' => $makanan_detail,
            'hpp_detail' => $hpp_detail,
            'bahan_makanan' => $results,
            'perioderesep' => $perioderesep,
            'btkl' => $btkl,
            'bop' => $bop,
            'bop2' => $bop2,
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
            // 'qty'  => 'required|array|min:3',
            // 'qty.*'  => 'required|numeric'
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
        $b = Resep::where('makanan_id',$kd_makanan)->get();
        //mengambil data BOP granitur
        $bo1 = Bop::where('id',1)->first();
        $bo2 = Bop::where('id',2)->first();
        //mengambil data BTKL
        $btkl = Btkl::where('id',1)->first();
        //mengambil array untuk mengambil data harga 
        foreach ($b as $p) {
             $harga[] = $p->bahan->harga ;  
        };
        //Total dari penjumlahan (harga satuan bahan * qty)
        $totalbahanqty = 0;
        foreach($harga AS $k=>$v){
          $totalbahanqty += $v*$qty[$k];
        }
        //BTKL untuk laporan per 1 makanan
        $besaran_btkl = $btkl->besaran;
        $totalbtkl = $besaran_btkl*1;
        //BOP GARNITURES & OTHER 
        $besaran_bo1 = $bo1->besaran;
        $totalgranitures =($besaran_bo1/100)*$totalbahanqty;
        //BOP sales Price
        $besaran_bo2 = $bo2->besaran;
        $cost_perportion = $totalbahanqty +$totalgranitures;
        $totalsales_price =($besaran_bo2/100) * $cost_perportion;
        //total BOP
        $totalbop =  $totalgranitures + $totalsales_price;
        //total hpp
        $total_hpp = $totalbahanqty + $totalbtkl + $totalbop;
        //hitung harga jual
        $jual = $total_hpp+$total_hpp*0.7;
        $juall = $jual*1.21;
        $jualll = round($juall);
        //simpan ke database
        $hpp = Hpp::create([
            'makanan_id' => $kd_makanan,
            'btkl_id' => $btkl->id,
            'bop1_id' => $bo1->id,
            'bop2_id' => $bo2->id,
            'besaran_btkl' => $btkl->besaran,
            'besaran_bop1' => $bo1->besaran,
            'besaran_bop2' => $bo2->besaran,
            'total_bahan' => $totalbahanqty,
            'total_btkl' => $totalbtkl,
            'total_bop' => $totalbop,
            'total_hpp' => $total_hpp,
            'h_jual' => $jualll,
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
        //mengambil banyak data untuk menampilan data sesuai makanan yang dipilih
        $resep_detail = Resep::where('makanan_id',$id)->get();
        //mengambil data detail HPP
        $hpp_detail = Hpp::where('makanan_id',$id)->first();
        //mengambil 1 data untuk patokan bahanbaku periode
        $perioderesep = Resep::where('makanan_id',$id)->first();
        //mengambil update data BOP BTKL untuk list manajemen
        $btkl = Btkl::where('id',1)->first();
        $bop = Bop::where('id',1)->first();
        $bop2 = Bop::where('id',2)->first();
    
        //buat array untuk menggabungkan semua data untuk menampilkan kumpulan dari array 
        $results=array();
        foreach($resep_detail as $key=>$data)
         {
            $tabel=array();
            $tabel['nama_bahan']=$data->bahan->nama_bahan;
            $tabel['unit']=$data->bahan->satuan;
            $tabel['qty']=$data->qty;
            $tabel['price']=$data->bahan->harga;
            $results[]=$tabel;
        }

        $data = [
            'title' => 'Detail Makanan',
            'makanan_detail' => $makanan_detail,
            'hpp_detail' => $hpp_detail,
            'bahan_makanan' => $results,
            'perioderesep' => $perioderesep,
            'btkl' => $btkl,
            'bop' => $bop,
            'bop2' => $bop2,
            'resep' => $this->resep,
            'hpp' =>  $this->hpp
        ];

  
        return view('cetak.cetak_hppmakanan', $data);
      
    }

    public function cetak_hppmakanan_pdf($id)
    {
        $makanan_detail = Makanan::find($id); 
        //mengambil banyak data untuk menampilan data sesuai makanan yang dipilih
        $resep_detail = Resep::where('makanan_id',$id)->get();
        //mengambil data detail HPP
        $hpp_detail = Hpp::where('makanan_id',$id)->first();
        //mengambil 1 data untuk patokan bahanbaku periode
        $perioderesep = Resep::where('makanan_id',$id)->first();
        //mengambil update data BOP BTKL untuk list manajemen
        $btkl = Btkl::where('id',1)->first();
        $bop = Bop::where('id',1)->first();
        $bop2 = Bop::where('id',2)->first();

        //buat array untuk menggabungkan semua data untuk menampilkan kumpulan dari array 
        $results=array();
        foreach($resep_detail as $key=>$data)
         {
            $tabel=array();
            $tabel['nama_bahan']=$data->bahan->nama_bahan;
            $tabel['unit']=$data->bahan->satuan;
            $tabel['qty']=$data->qty;
            $tabel['price']=$data->bahan->harga;
            $results[]=$tabel;
        }

        $data = [
            'title' => 'Detail Makanan',
            'makanan_detail' => $makanan_detail,
            'hpp_detail' => $hpp_detail,
            'bahan_makanan' => $results,
            'perioderesep' => $perioderesep,
            'btkl' => $btkl,
            'bop' => $bop,
            'bop2' => $bop2,
            'resep' => $this->resep,
            'hpp' =>  $this->hpp
        ];
  
        // instantiate and use the dompdf class

        $html = PDF::LoadView('cetak.cetak_hppmakanan_pdf', $data);
       
        $html->setPaper('A4', 'potrait');

   
        return $html->stream('Hpp.pdf');
    }
    
    
    
}
