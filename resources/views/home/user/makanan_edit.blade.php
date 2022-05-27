
        @extends('layout/main')
        @section('container')
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Makanan</h1>
            
          
           
            <div class="row">
              <div class="col-xl-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <i class="fas fa-list-alt"></i>
                    Edit Deskripsi Makanan 
                  </div>
                  <div class="kembali">
                    <i class="fas fa-arrow-left"></i><a href="/makanan"> Kembali</a>
                  </div>
                  <form method="POST" action="{{route('updatem',$makanan['id'])}}">
                    @csrf
                    <div class="form-group p-3">
                      <div class="mb-2">
                        <label for="exampleInputEmail1">Kode Makanan</label>
                        <input type="text" class="form-control" name="kd_makanan"  value="{{$makanan->kd_makanan}}" readonly>
                        </div>
                        @if (auth()->user()->level == "user")
                        <input type="hidden" name="user_id" id="hiddenInput" value="{{Auth::user()->id}}" />
                        @endif
                        @if (auth()->user()->level == "admin")
                        <div class="mb-2">
                          <label for="exampleInputEmail1">Nama Chef</label>
                          <input type="text" class="form-control" name="nama_chef"  value="{{$makanan->user->username}}" readonly>
                          <input type="hidden" name="user_id" id="hiddenInput" value="{{$makanan->user->id}}" />
                          </div>
                          @endif
                      <div class="mb-2">
                      <label for="exampleInputEmail1 mb-2">Nama Makanan</label>
                      <input type="text" class="form-control" name="nama_makanan" id="nama_makanan" value="{{$makanan->nama_makanan}}"  placeholder="Masukkan Nama Makanan" required>
                      </div>
                   
                      <div class="mb-2">
                      <label for="exampleInputEmail1">Kategori Makanan</label>
                      <select class="form-select" name="id_kategori" aria-label="Default select example">
                      
                        @foreach ($kategori as $kat)
                    
                        <option value="{{ $kat->id }}" {{ ($makanan->kategori_id == $kat->id ) ? 'selected' : null }}> {{ $kat->nama_kategori }} </option>
                        @endforeach
           
                      </select>
                      </div>
                      <div class="form-group mb-2">
                        <label for="exampleFormControlTextarea1">Penyajian Makanan</label>
                        <textarea class="form-control" name="penyajian" id="exampleFormControlTextarea1" required rows="3">{{$makanan->penyajian}}</textarea>
                      </div>
                      <button type="submit" class="btn btn-primary mt-3">Tambah</button>

                      @if(session()->has('sukses'))
                      <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                        {{session('sukses')}}
                      </div>
                      @endif
                  

                  </form>
                </div>
              </div>
            
      
          </div>
        </div>
        </main>
        @endsection