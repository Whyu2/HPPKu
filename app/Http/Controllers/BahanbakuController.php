<?php

namespace App\Http\Controllers;

use App\Models\Bahanbaku;
use Illuminate\Http\Request;

class BahanbakuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $b = Bahanbaku::paginate(15);
    
        $data = [
            'title' => 'Bahan Baku',
            'BahanBaku' => $b
        ];
    
        return view('home.user.bahanbaku', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bahan = Bahanbaku::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(3)) , 3,"0") as bahan')->first();
        $addkode = new Bahanbaku();
        $addkode->bahan = 'KB'. $bahan->bahan; 
   
     
        $data = [
            'title' => 'Tambah Bahan Baku',
            'kode' =>   $addkode
        
        ];
        return view('home.user.bahanbaku_tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_b' => 'required|max:128',
            'satuan' => 'required|max:11',
            'harga' => 'required|numeric',
        ]);
        
            $bahanbaku = Bahanbaku::create([
                'kd_bahan' => $request->kd_bahan,
                'nama_bahan' => $request->nama_b,
                'satuan' => $request->satuan,
        
                'harga' => $request->harga,
        ]);

        return redirect('/bahan_baku')->with('tambah', 'Data Bahan Baku, Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bahanbaku  $bahanbaku
     * @return \Illuminate\Http\Response
     */
    public function show(Bahanbaku $bahanbaku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bahanbaku  $bahanbaku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $b = Bahanbaku::find($id);
 
        $data = [
            'title' => 'Edit Bahan Baku',
            'bahanbaku' => $b,
        ];
     
        return view('home.user.bahanbaku_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bahanbaku  $bahanbaku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_b' => 'required|max:128',
            'satuan' => 'required|max:11',
            'harga' => 'required|numeric',
        ]);

            $bahanbaku = Bahanbaku::whereId($id)->first();
            $bahanbaku->update([
                'kd_bahan' => $request->kd_bahan,
                'nama_bahan' => $request->nama_b,
                'satuan' => $request->satuan,
     
                'harga' => $request->harga,
        ]);
        return redirect('/bahan_baku')->with('suksesedit', 'Data Bahan Baku, Berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bahanbaku  $bahanbaku
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     Bahanbaku::whereId($id)->delete();
    //     return redirect('/bahan_baku')->with('hapus', 'Data Bahan Baku berhasil dihapus!');
    // }

    public function destroy(Request $request)
    {
        $id= $request->input('delete_bahan');
            Bahanbaku::whereId($id)->delete();
            return redirect('/bahan_baku')->with('hapus', 'Data Bahan baku berhasil dihapus!');
    }

    public function getBahan(Request $request){
        $bahanbaku = Bahanbaku::where("kd_bahan",$request->bahID)->pluck('kd_bahan','nama_bahan');
        return response()->json($bahanbaku);
    }
}
