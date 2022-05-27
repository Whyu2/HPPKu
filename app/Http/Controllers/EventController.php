<?php

namespace App\Http\Controllers;

use App\Models\Eveent;
use App\Models\Eveent_makanan;
use App\Models\Hpp;
use App\Models\Resep;
use App\Models\Waktu;
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

        $events = Eveent::create([
            'waktu_id' => $request->id_waktu,
            'kd_event' => $addkode,
            'nama_event' => $request->nama_event,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
         ]);


        //mengambil id event untuk di masukkan ke database eveent_makanan   
         $ke = Eveent::where('kd_event', $addkode)->first();
       //insert daftar makanan (yang sudah dihitung hppnya)
         $hpp_id = $request->hpp_id;
         $qty = $request->qty;
      
        for ($i=0; $i<count($hpp_id); $i++){
                $save = [
                'eveent_id' => $ke->id,
                'hpp_id' => $hpp_id[$i],
                'qty' => $qty[$i],
            ];
            DB::table('eveent_makanans')->insert($save);
        }

        //perhitungan untuk menentukan total produksi, jual berdasarkan lama event
        $days =   $this->eveent->lamaevent($ke->tgl_mulai,$ke->tgl_selesai);
        //jumlah porsi
        $tot_porsi = $this->eveent_makanan->totalqty($ke->id);
        //total hpp * lama event
        $tot_hpp = $this->eveent_makanan->totalhpp($ke->id);
        $tot_hpp_day= $tot_hpp * $days;
        //total jual * lama event
        $tot_jual = $this->eveent_makanan->totalqtyjual($ke->id);
        $tot_jual_day= $tot_jual * $days;
        $event_save = Eveent::whereId($ke->id)->first();
        $event_save->update([
            'total_porsi' => $tot_porsi,
            'total_produksi' =>$tot_hpp_day,
            'total_jual' => $tot_jual_day
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

                 //ambil array hpp
                foreach ($m as $p) {
                $hpp[] = $p->hpp->total_hpp ;  
                };
                //ambil array harga jual
                foreach ($m as $p) {
                $jual[] = $p->hpp->h_jual ;  
                };
       
                //ambil array qty
                foreach ($m as $q) {
                $qty[] = $q->qty;
                };
                //proses perhitungan * qty
               //hpp*qty
               $hpp_qty = [];
               foreach($qty as $i=>$val){
               array_push($hpp_qty, $qty[$i] * $hpp[$i]);
               }

                //harga jual*qty
               $jual_qty = [];
               foreach($qty as $i=>$val){
               array_push($jual_qty, $qty[$i] * $jual[$i]);
               }
               $results=array();
               //menggabungkan array
               foreach($m as $key=>$data)
                {
                   $tabel=array();
                   $tabel['nama_makanan']=$data->hpp->makanan->nama_makanan;
                   $tabel['id_makanan']=$data->hpp->makanan->id;
                   $tabel['qty']=$data->qty;
                   $tabel['total_btkl']=$data->hpp->total_btkl;
                   $tabel['total_hpp']=$data->hpp->total_hpp;
                   $tabel['total_jual']=$data->hpp->h_jual;
                   $tabel['hpp_qty']=$hpp_qty[$key];
                   $tabel['jual_qty']=$jual_qty[$key];
                   $results[]=$tabel;
               }
        $data = [
            'title' => 'Detail Event',
            'detail' => $detail,
            'hpps' => $results,
            'lama' => $days,
            'event' =>$this->eveent,
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

                 //ambil array hpp
                foreach ($m as $p) {
                $hpp[] = $p->hpp->total_hpp ;  
                };
                //ambil array harga jual
                foreach ($m as $p) {
                $jual[] = $p->hpp->h_jual ;  
                };
       
                //ambil array qty
                foreach ($m as $q) {
                $qty[] = $q->qty;
                };
                //proses perhitungan * qty
               //hpp*qty
               $hpp_qty = [];
               foreach($qty as $i=>$val){
               array_push($hpp_qty, $qty[$i] * $hpp[$i]);
               }

                //harga jual*qty
               $jual_qty = [];
               foreach($qty as $i=>$val){
               array_push($jual_qty, $qty[$i] * $jual[$i]);
               }
               $results=array();
               //menggabungkan array
               foreach($m as $key=>$data)
                {
                   $tabel=array();
                   $tabel['nama_makanan']=$data->hpp->makanan->nama_makanan;
                   $tabel['id_makanan']=$data->hpp->makanan->id;
                   $tabel['qty']=$data->qty;
                   $tabel['total_btkl']=$data->hpp->total_btkl;
                   $tabel['total_hpp']=$data->hpp->total_hpp;
                   $tabel['total_jual']=$data->hpp->h_jual;
                   $tabel['hpp_qty']=$hpp_qty[$key];
                   $tabel['jual_qty']=$jual_qty[$key];
                   $results[]=$tabel;
               }
        $data = [
            'title' => 'Detail Event',
            'detail' => $detail,
            'hpps' => $results,
            'lama' => $days,
            'event' =>$this->eveent,
            'eveent_makanan' => $this->eveent_makanan
        ];
        return view('cetak.cetak_eventorder', $data);
    }

    public function cetak_eventorder_pdf($id){
        $detail = Eveent::find($id);
        $m = Eveent_makanan::where('eveent_id',$id)->get();
        //lama event
        $days = $this->eveent->lamaevent($detail->tgl_mulai,$detail->tgl_selesai);

                 //ambil array hpp
                foreach ($m as $p) {
                $hpp[] = $p->hpp->total_hpp ;  
                };
                //ambil array harga jual
                foreach ($m as $p) {
                $jual[] = $p->hpp->h_jual ;  
                };
       
                //ambil array qty
                foreach ($m as $q) {
                $qty[] = $q->qty;
                };
                //proses perhitungan * qty
               //hpp*qty
               $hpp_qty = [];
               foreach($qty as $i=>$val){
               array_push($hpp_qty, $qty[$i] * $hpp[$i]);
               }

                //harga jual*qty
               $jual_qty = [];
               foreach($qty as $i=>$val){
               array_push($jual_qty, $qty[$i] * $jual[$i]);
               }
               $results=array();
               //menggabungkan array
               foreach($m as $key=>$data)
                {
                   $tabel=array();
                   $tabel['nama_makanan']=$data->hpp->makanan->nama_makanan;
                   $tabel['id_makanan']=$data->hpp->makanan->id;
                   $tabel['qty']=$data->qty;
                   $tabel['total_btkl']=$data->hpp->total_btkl;
                   $tabel['total_hpp']=$data->hpp->total_hpp;
                   $tabel['total_jual']=$data->hpp->h_jual;
                   $tabel['hpp_qty']=$hpp_qty[$key];
                   $tabel['jual_qty']=$jual_qty[$key];
                   $results[]=$tabel;
               }
        $data = [
            'title' => 'Detail Event',
            'detail' => $detail,
            'hpps' => $results,
            'lama' => $days,
            'event' =>$this->eveent,
            'eveent_makanan' => $this->eveent_makanan
        ];
       
        $html = PDF::LoadView('cetak.cetak_eventorder_pdf', $data);
       
        $html->setPaper('A4', 'potrait');

   
        return $html->stream('Hpp.pdf');
    }
}
