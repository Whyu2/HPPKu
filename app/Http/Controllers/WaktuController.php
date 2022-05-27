<?php

namespace App\Http\Controllers;

use App\Models\Waktu;
use Illuminate\Http\Request;

class WaktuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $w = Waktu::all();
      
        $data = [
            'title' => 'Waktu Makan',
            'waktu' => $w
        ];
        return view('home.user.waktu', $data);
      
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
            'nama_waktu' => 'required|max:128|unique:waktus,nama_waktu',
        ]);
        
            $waktus = Waktu::create([
                'nama_waktu' => $request->nama_waktu
        ]);

        return redirect('/waktu')->with('sukses', 'Data waktu, Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Waktu  $waktu
     * @return \Illuminate\Http\Response
     */
    public function show(Waktu $waktu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Waktu  $waktu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $w = Waktu::find($id);

        $data = [
            'title' => 'Edit Waktu',
            'waktu' => $w,
        ];
     
        return view('home.user.waktu_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Waktu  $waktu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_waktu' => 'required']);

            $waktus = Waktu::whereId($id)->first();
            $waktus->update([
                'nama_waktu' => $request->nama_waktu
            ]);

        return redirect('/waktu')->with('suksesedit', 'Data waktu berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Waktu  $waktu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id= $request->input('delete_waktu');
        Waktu::whereId($id)->delete();
        return redirect('/waktu')->with('hapus', 'Data waktu berhasil dihapus!');
    }
}
