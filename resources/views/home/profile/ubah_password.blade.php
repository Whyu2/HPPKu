
        @extends('layout/main')
        @section('container')
        <main>
            <div class="container-fluid px-4">
              <h1 class="mt-4">Profile</h1>
              <div class="row">
                <div class="col-xl-12">
              <div class="card">
                <div class="card-header">
                  <i class="fas fa-user"></i>
                Profile
                </div>
                <div class="kembali">
                  <i class="fas fa-arrow-left"></i><a href="{{route('profile',auth()->user()->id)}}"> Kembali</a>
                </div>
              <div class="row">
                <div class="col-4 border-right mt-2 mb-2">
                  <div class="text-center">
                    @if (auth()->user()->level == "user")
                    <img src="{{ asset('img/chef.jpg') }}" class="img-profile rounded" alt="...">
                    @endif
                    @if (auth()->user()->level == "admin")
                    <img src="{{ asset('img/admin.png') }}" class="img-profile rounded" alt="...">
                    @endif
                  </div>
                </div>
               

              <div class="col-6 mt-2 mb-2">
                <h4>Ubah Password</h4>
                @if(session()->has('suksesedit'))
                <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                  {{session('suksesedit')}}
                </div>
                @endif
                @if(session()->has('gagaledit'))
                <div class="alert alert-danger allert-dismissible fade show" role="alert">
                  {{session('gagaledit')}}
                </div>
                @endif
                <form method="post" action="{{route('simpan_password',$user['id'])}}">
                  @csrf
                <label class="mb-1" for="">Password Sekarang</label>
                <div class="col-md-3 input-group mb-3">
                  <input type="text" name="current_password" class="form-control" placeholder="Masukkan Password Sekarang" aria-label="Username" aria-describedby="basic-addon1" id="current_password" autofocus required>
                 </div>
                 <label class="mb-1" for="">Password Baru</label>
                 <div class="col-md-3 input-group mb-3">
                   <input type="text" name="password_new"" class="form-control" placeholder="Masukkan Password Baru" aria-label="Username" aria-describedby="basic-addon1" id="password_new"  required>
                  </div>
                  <label class="mb-1" for="">Konfirmasi Password Baru</label>
                  <div class="col-md-3 input-group mb-3">
                    <input type="text" name="password_confirmation" class="form-control" placeholder="Masukkan Konfirmasi Password Baru" aria-label="Username" aria-describedby="basic-addon1" id="password_confirmation" required >
                   </div>
                  <div class="row">
                  <div class="col-6">
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                   </div>
                  </form>
                   <div class="col-6 ">
                    <button type="reset" class="btn btn-danger ">Reset</button>
                   </div>
                  </div>
              </div>
            </div>         
            </div>
          </div>
        </div>
        </main>
      </main>
        @endsection