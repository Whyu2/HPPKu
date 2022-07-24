<?php

namespace App\Http\Controllers;

use App\Models\Eveent;
use App\Models\Eveent_makanan;
use App\Models\Hpp;
use App\Models\Resep;
use App\Models\Waktu;
use App\Models\Btkl;
use App\Models\Bop;
use App\Models\Cost;
use App\Models\Makanan;
use Eveent as GlobalEveent;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;
use Barryvdh\DomPDF\Facade\Pdf;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->hpp = new HPP();
        $this->eveent_makanan = new Eveent_makanan();
        $this->eveent = new Eveent();
        $this->resep = new Resep();
    }
    public function home()
    {
        //data untuk form
        $event = Eveent::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(3)) , 3,"0") as event')->first();
        $addkode = new Eveent();
     
        $addkode->event = 'E'. $event->event; 
        $eveent_makanan = new Eveent_makanan();
        $waktu  = Waktu::all();
        $hpp  = Hpp::all();
        $l = Eveent::all();
        $d = Carbon::now()->format('Y-m-d H:i:s');
        
        $data = [
            'title' => 'Tambah Event',
            'addkode' =>  $addkode,
            'waktu' =>  $waktu,
            'hpp' =>  $hpp,
            'list' =>  $l,
            'event' =>$this->eveent,
            'eveent_makanan' => $eveent_makanan,
            'date'=> $d,
        
        ];
     
        return view('home.user.event_tambah', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //membuat kode untuk event
        $event = Eveent::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(3)) , 3,"0") as event')->first();
        $addkode = new Eveent();
        $addkode = 'E'. $event->event;

       //insert deskripsi event
        $tgl_mulai = date('Y-m-d H:i:s', strtotime($request->tgl_mulai));
        $tgl_selesai = date('Y-m-d H:i:s', strtotime($request->tgl_selesai));
        $days =   $this->eveent->lamaevent($tgl_mulai,$tgl_selesai);
        
        $events = Eveent::create([
            'waktu_id' => $request->id_waktu,
            'kd_event' => $addkode,
            'nama_event' => $request->nama_event,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
         ]);


        //mengambil id event untuk di masukkan ke database eveent_makanan   
         $ke = Eveent::where('kd_event', $addkode)->first();
        //mengambil data BTKL
        $btkl = Btkl::where('id',1)->first();
        //mengambil data BOP granitur
        $bop = Bop::where('id',1)->first();
         //mengambil data cost
         $cost = Cost::where('id',1)->first();
        
       //insert daftar makanan (yang sudah dihitung hppnya)
         $hpp_id = $request->hpp_id;
         $qty = $request->qty;
      
        for ($i=0; $i<count($hpp_id); $i++){
                $save = [
                'eveent_id' => $ke->id,
                'hpp_id' => $hpp_id[$i],
                'qty' => $qty,
            ];
            DB::table('eveent_makanans')->insert($save);
        }
        //jumlah porsi
        $tot_porsi = $this->eveent_makanan->totalqty($ke->id);
        //menghitung total bahan sesuai dengan porsi makanan
        $m = Eveent_makanan::where('eveent_id',$ke->id)->get();
        foreach ($m as $p) {
            $qty = $p->qty ;
            //memanggil fuction untuk array bahan bakunya
            $listbahan =  $this->resep->listbahan($p->hpp->makanan->id);  
            foreach ($listbahan as $b){
                //memanggil fuction untuk mengkalikan qty pada bahan sesuai jumlah porsi  
                $tot_qty = $this->eveent_makanan->total_qty($b->bahan->id, $qty);
                //memanggil fuction untuk mengkalikan total qty dengan harga satuan bahanbaku   
                $tot_bahan_qty[] = $this->hpp->bahanqty($tot_qty,$b->bahan->harga );
            }
       };
       //penjumlahan total array
       $total_bahan = array_sum($tot_bahan_qty);
       //Besaran BTKL
       $btkl = $btkl->besaran;
       $total_btkl = $tot_porsi * $btkl;
        //Besaran BOP
       $besaran_bop = $bop->besaran;
       $total_overhead =($besaran_bop/100)*$total_bahan;
       //Total HPP
       $total_hpp = $total_bahan + $total_btkl + $total_overhead;
       //Besaran HPP perporsi
       $biaya_perporsi = $total_hpp/ $tot_porsi;
        //Besaran Cost 
       $besaran_cost = $cost->besaran;
        //Harga jual
       $h_jual = ($biaya_perporsi/$besaran_cost)*100;
       $harga_jual_perporsi = $h_jual*1.21;
        //perhitungan untuk menentukan total produksi, jual berdasarkan lama event
        $days =   $this->eveent->lamaevent($ke->tgl_mulai,$ke->tgl_selesai);
        //harga jual dikalikan porsi
        $rev =  $harga_jual_perporsi*$tot_porsi;
        //total jual dikurangi hpp
        $revv = $rev - $total_hpp;
        //revenue dikalikan dengan lama event
        $revenue = $revv * $days;
        $event_save = Eveent::whereId($ke->id)->first();
        $event_save->update([
            'total_bahan' => $total_bahan,
            'total_btkl' => $total_btkl,
            'total_bop' => $total_overhead,
            'porsi' => $tot_porsi,
            'total_produksi' => $total_hpp,
            'total_produksi_p' => $biaya_perporsi,
            'h_jual_p' => $harga_jual_perporsi,
            'revenue' => $revenue,
        ]);
        //insert data detail hpp
        return redirect('/event')->with('tambah', 'Data Event, Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */

    public function detail($id)
    {
        $detail = Eveent::find($id);
        $m = Eveent_makanan::where('eveent_id',$id)->get();
        //lama event
        $days = $this->eveent->lamaevent($detail->tgl_mulai,$detail->tgl_selesai);
        //mengambil data BOP
        $bop = Bop::where('id',1)->first();
        //mengambil data BTKL
        $btkl = Btkl::where('id',1)->first();
        //mengambil data cost
        $cost = Cost::where('id',1)->first();
        $data = [
            'title' => 'Detail Event',
            'detail' => $detail,
            'btkl' => $btkl,
            'bop' => $bop,
            'cost' => $cost,
            'hpps' => $m,
            'lama' => $days,
            'event' =>$this->eveent,
            'hpp' =>$this->hpp,
            'resep' =>$this->resep,
            'eveent_makanan' => $this->eveent_makanan
        ];
        return view('home.user.event_detail', $data);

    }
    public function show(Eveent $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Eveent $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eveent $event)
    {
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id= $request->input('delete_event');

      
        Eveent::whereId($id)->delete();
        return redirect('/event')->with('hapus', 'Data Event Berhasil Dihapus!');
    }

    public function cetak_eventorder($id){
        $detail = Eveent::find($id);
        $m = Eveent_makanan::where('eveent_id',$id)->get();
        //lama event
        $days = $this->eveent->lamaevent($detail->tgl_mulai,$detail->tgl_selesai);
        //mengambil data BOP
        $bop = Bop::where('id',1)->first();
        //mengambil data BTKL
        $btkl = Btkl::where('id',1)->first();
        //mengambil data cost
        $cost = Cost::where('id',1)->first();
        $data = [
            'title' => 'Detail Event',
            'detail' => $detail,
            'btkl' => $btkl,
            'bop' => $bop,
            'cost' => $cost,
            'hpps' => $m,
            'lama' => $days,
            'event' =>$this->eveent,
            'hpp' =>$this->hpp,
            'resep' =>$this->resep,
            'eveent_makanan' => $this->eveent_makanan
        ];
        return view('cetak.cetak_eventorder', $data);
    }

    public function cetak_eventorder_pdf($id){
        $detail = Eveent::find($id);
        $m = Eveent_makanan::where('eveent_id',$id)->get();
        //lama event
        $days = $this->eveent->lamaevent($detail->tgl_mulai,$detail->tgl_selesai);
        //mengambil data BOP
        $bop = Bop::where('id',1)->first();
        //mengambil data BTKL
        $btkl = Btkl::where('id',1)->first();
        //mengambil data cost
        $cost = Cost::where('id',1)->first();
        $data = [
            'title' => 'Detail Event',
            'detail' => $detail,
            'btkl' => $btkl,
            'bop' => $bop,
            'cost' => $cost,
            'hpps' => $m,
            'lama' => $days,
            'event' =>$this->eveent,
            'hpp' =>$this->hpp,
            'resep' =>$this->resep,
            'eveent_makanan' => $this->eveent_makanan
        ];
       
        $html = PDF::LoadView('cetak.cetak_eventorder_pdf', $data);
       
        $html->setPaper('A4', 'potrait');

   
        return $html->stream('Hpp.pdf');
    }
}
