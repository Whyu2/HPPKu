<?php

namespace App\Http\Controllers;


use App\Models\Kategori;
use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MakananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function home()
    {
        $m = Makanan::paginate(15);
      
        $data = [
            'title' => 'Makanan',
            'makanan' => $m
        ];
        return view('home.user.makanan', $data);
      
    }
    public function create()
    {
        $makanan = Makanan::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(3)) , 3,"0") as makanan')->first();
        $addkode = new Makanan();

        $addkode->makanan = 'MK'. $makanan->makanan; 
        $kategori  = Kategori::all();
    
        $data = [
            'title' => 'Tambah Makanan',
            'kode' =>   $addkode,
            'kategori' => $kategori
        ];
        return view('home.user.makanan_tambah', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kd_makanan' => 'required',
            'nama_makanan' => 'required|max:128|unique:makanans,nama_makanan',
            'id_kategori' => 'required',
            'penyajian' => 'required',
        ]);

            $makanan = Makanan::create([
                'user_id' => Auth::user()->id,
                'kategori_id' => $request->id_kategori,
                'kd_makanan' => $request->kd_makanan,
                'nama_makanan' => $request->nama_makanan,
                'penyajian' => $request->penyajian
        ]);
     
        return redirect('/makanan')->with('tambah', 'Data Makanan, Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HPP  $hPP
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HPP  $hPP
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mk = Makanan::find($id);
        
        $kategori  = Kategori::all();
        $data = [
            'title' => 'Edit Makanan',
            'makanan' => $mk,
            'kategori' => $kategori
        ];
     
        return view('home.user.makanan_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HPP  $hPP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kd_makanan' => 'required',
            'nama_makanan' => 'required',
            'id_kategori' => 'required',
            'penyajian' => 'required',
        ]);
      
            $makanan = Makanan::whereId($id)->first();
            $makanan->update([
                'user_id' => $request->user_id,
                'kategori_id' => $request->id_kategori,
                'kd_makanan' => $request->kd_makanan,
                'nama_makanan' => $request->nama_makanan,
                'penyajian' => $request->penyajian
        ]);
     
        return redirect('/makanan')->with('suksesedit', 'Data Makanan Berhasil Diedti!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HPP  $hPP
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     Makanan::whereId($id)->delete();
    //     return redirect('/makanan')->with('hapus', 'Data Makanan berhasil dihapus!');

    // }
    public function destroy(Request $request)
    {
        $id= $request->input('delete_makanan');
            Makanan::whereId($id)->delete();
            return redirect('/makanan')->with('hapus', 'Data Makanan berhasil dihapus!');
    }


    public function getmakanan(Request $request){
        $id_makanan = $request->id_makanan;

        $makanans = Makanan::find($id_makanan);
            echo "$makanans->id";
       
    }
}
