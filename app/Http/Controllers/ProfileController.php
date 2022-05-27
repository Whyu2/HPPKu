<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Echo_;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home($id)
    {
        $u = User::find($id);
        $data = [
            'title' => 'Edit Akun',
            'user' => $u
        ];

        return view('home.profile.home', $data);
    }

    public function ubah_password($id)
    {
        $u = User::find($id);
        $data = [
            'title' => 'Ubah Password',
            'user' => $u
        ];

        return view('home.profile.ubah_password', $data);
    }
    public function simpan_password(Request $request)
    {

        
  
       
          $user = Auth::user();
        //   dd($request->get('current_password'));
          if (!(Hash::check($request->current_password, Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("gagaledit","Password yang di masukkan tidak sesuai !");
        }

        if(strcmp($request->current_password, $request->password_new) == 0){
            // Current password and new password same
            return redirect()->back()->with("gagaledit","Password baru tidak boleh sama dengan password lama !");
        }
        if(strcmp($request->password_new, $request->password_confirmation) == 1){
            // Current password and new password same
            return redirect()->back()->with("gagaledit","Konfirmasi password salah, masukkan ulang !");
        }

        
        $request->validate([
            // 'current_password' => 'required',
            // 'password_new' => 'required|string|min:8|confirmed',
          ]);
          $request->user()->fill([
            'password' => Hash::make($request->password_new)
        ])->save();
        return redirect()->back()->with("suksesedit","Password berhasil diubah !");
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
            'username' => 'required']);
            $user = User::whereId($id)->first();
            $userr = Auth::user();

            $user->update([
                'username' => $request->username,
                'password' => $user->password,
                'level' => $user->level,
            ]);
            return redirect()->action(
                [ProfileController::class, 'home'], ['id' => $userr->id]
            )->with('suksesedit', 'Username Berhasil Diubah');
      
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
