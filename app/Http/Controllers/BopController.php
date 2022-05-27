<?php

namespace App\Http\Controllers;

use App\Models\Bop;
use Illuminate\Http\Request;

class BopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
     
        $bo1 = Bop::find(1);
        $bo2 = Bop::find(2);

        $data = [
            'title' => 'Edit BOP',
            'bo1' => $bo1,
            'bo2' => $bo2
        ];
     
        return view('home.user.bop', $data);
        // $b = Bop::all();
        // $data = [
        //     'title' => 'Biaya Overhead Pabrik',
        //     'bop' =>   $b
        // ];
        // return view('home.user.bop', $data);
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
        $bo = Bop::find($id);

        $data = [
            'title' => 'Edit BOP',
            'bo' => $bo,
        ];
     
        return view('home.user.bop_edit', $data);
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
        $request->validate([
            'keterangan' => 'required|max:128',
            'besaran' => 'required|numeric'
        ]);
            $bop = Bop::whereId($id)->first();
            $bop->update([
                'keterangan' => $request->keterangan,
                'besaran' => $request->besaran,
            ]);

        return redirect('/bop')->with('suksesedit', 'Data Granitres & other Berhasil diedit!');
    }


    public function update2(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|max:128',
            'besaran' => 'required|numeric'
        ]);

            $bop = Bop::whereId($id)->first();
            $bop->update([
                // 'nama_bop' => $request->nama_bop,
                'keterangan' => $request->keterangan,
                'besaran' => $request->besaran,
            ]);

        return redirect('/bop')->with('suksesedit2', 'Data Sales Price Berhasil diedit!');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
