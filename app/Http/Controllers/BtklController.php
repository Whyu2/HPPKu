<?php

namespace App\Http\Controllers;

use App\Models\Btkl;
use Illuminate\Http\Request;

class BtklController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        // $btkl = Btkl::all();
        // $data = [
        //     'title' => 'Biaya Tenaga Kerja Langsung',
        //     'btkl' =>   $btkl
        // ];
        // return view('home.user.btkl', $data);
        $bt = Btkl::find(1);

        $data = [
            'title' => 'Edit BTKL',
            'bt' => $bt,
        ];
     
        return view('home.user.btkl', $data);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Btkl  $btkl
     * @return \Illuminate\Http\Response
     */
    public function show(Btkl $btkl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Btkl  $btkl
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bt = Btkl::find($id);

        $data = [
            'title' => 'Edit BTKL',
            'bt' => $bt,
        ];
     
        return view('home.user.btkl_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Btkl  $btkl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_btkl' => 'required|max:128',
            'keterangan' => 'required|max:128',
            'besaran' => 'required|numeric'
        ]);

            $bop = Btkl::whereId($id)->first();
            $bop->update([
                'nama_btkl' => $request->nama_btkl,
                'keterangan' => $request->keterangan,
                'besaran' => $request->besaran,
            ]);

        return redirect('/btkl')->with('suksesedit', 'Data BTKL Berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Btkl  $btkl
     * @return \Illuminate\Http\Response
     */
    public function destroy(Btkl $btkl)
    {
        //
    }
}
