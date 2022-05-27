
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
                    <strong>   Masukkan Deskripsi Makanan </strong>
                  </div>
                  <form action="/makanan/store" method="post">
                    @csrf
                    <div class="form-group p-3">
                      <div class="mb-2">
                        <label for="exampleInputEmail1">Kode Makanan</label>
                        <input type="text" class="form-control" name="kd_makanan"  value="{{$kode->makanan}}" readonly>
                        </div>
                      <div class="mb-2">
                      <label for="exampleInputEmail1 mb-2">Nama Makanan</label>
                    
                      <input type="text" class="form-control @error('nama_makanan') is-invalid @enderror" id="nama_makanan"
                      placeholder="Nama Makanan" value="{{ old('nama_makanan') }}" name="nama_makanan" required>
                       @error('nama_makanan')
                      <div class="invalid-feedback"> {{ $message }}</div>
                      @enderror
                      </div>
                   
                      <div class="mb-2">
                      <label for="exampleInputEmail1">Kategori Makanan</label>
                      <select class="form-select" name="id_kategori" aria-label="Default select example" required>
                        <option value="" selected>Pilih Kategori</option>
                        @foreach ($kategori as $kat)
                        <option value="{{$kat->id}}">{{$kat->nama_kategori}}</option>
                        @endforeach
                      </select>
                      </div>
                      <div class="form-group mb-2">
                        <label for="exampleFormControlTextarea1">Penyajian Makanan</label>
                        {{-- <textarea class="form-control" name="penyajian" id="exampleFormControlTextarea1" rows="3"></textarea> --}}
                        <textarea  class="form-control @error('penyajian') is-invalid @enderror" id="penyajian"
                        placeholder="Penyajian" value="{{ old('penyajian') }}" name="penyajian" id="exampleFormControlTextarea1" rows="3" required></textarea>
                         @error('penyajian')
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-primary mt-3">Tambah</button>
                      <button type="reset" class="btn btn-danger mt-3">Reset</button>
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