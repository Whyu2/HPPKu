
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
                Edit Akun
                </div>
                <div class="kembali mt-4">
         <h1></h1>
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
                <h4>Username</h4>
                @if(session()->has('suksesedit'))
                <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                  {{session('suksesedit')}}
                </div>
                @endif
                <form method="post" action="{{route('editp',$user['id'])}}">
                  @csrf
                <label class="mb-1" for="">Username</label>
                <div class="col-md-3 input-group mb-3">
                  <input type="text" name="username" value="{{$user->username}}" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" id="username" autofocus required>
                 </div>
                  <div class="row">
                  <div class="col-6">
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                   </div>
                  </div>
                  </form>
                  <div class="row">
                   <div class="col-6 mt-3">
                    <a href="{{route('ubah_password',auth()->user()->id)}}" type="submit" class="btn btn-danger ">Ubah password</a>
                   </div>
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