<?php

namespace App\Http\Controllers;

use App\Models\Kategori;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function home()
    {
        $k = Kategori::paginate(15);
      
        $data = [
            'title' => 'Kategori',
            'kategori' => $k
        ];
   
        return view('home.user.kategori_tambah', $data);
      
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
        $request->validate([
            'nama_kategori' => 'required|max:128|unique:kategoris,nama_kategori',
        ]);
        
            $kategoris = Kategori::create([
                'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/kategori')->with('sukses', 'Data kategori, Berhasil Ditambah!');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kp = Kategori::find($id);

        $data = [
            'title' => 'Edit Kategori',
            'kategori' => $kp,
        ];
     
        return view('home.user.kategori_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|max:128|unique:kategoris,nama_kategori',
        ]);

            $kategori = Kategori::whereId($id)->first();
            $kategori->update([
                'nama_kategori' => $request->nama_kategori
            ]);

        return redirect('/kategori')->with('suksesedit', 'Data kategori Berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //         Kategori::whereId($id)->delete();
    //         return redirect('/kategori')->with('hapus', 'Data Kategori berhasil dihapus!');
    // }

    public function destroy(Request $request)
    {
        $id= $request->input('delete_kategori');
            Kategori::whereId($id)->delete();
            return redirect('/kategori')->with('hapus', 'Data Kategori berhasil dihapus!');
    }
}
