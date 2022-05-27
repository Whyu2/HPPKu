
        @extends('layout/main')
        @section('container')
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Bahan Baku</h1>
            
          
           
            <div class="row">
              <div class="col-xl-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <i class="fas fa-mortar-pestle"></i>
                    <strong>    Tambah Bahan Baku </strong>
                  </div>
                  <div class="kembali">
                    <i class="fas fa-arrow-left"></i><a href="/bahan_baku"> Kembali</a>
                  </div>
                  <form action="/bahan_baku/store" method="post">
                    @csrf
                   
                    <div class="form-group p-3">
                      <div class="mb-2">
                      <label for="exampleInputEmail1">Kode Bahan Baku</label>
                      <input type="text" class="form-control" name="kd_bahan" value="{{$kode->bahan}}" readonly>
                      </div>
                      <div class="mb-2">
                      <label for="exampleInputEmail1">Nama Bahan</label>
                      <input type="text" class="form-control @error('nama_b') is-invalid @enderror" id="nama_b"
                      placeholder="Nama Bahan" value="{{ old('nama_b') }}" name="nama_b" required>
                       @error('nama_b')
                      <div class="invalid-feedback"> {{ $message }}</div>
                      @enderror
                      </div>
                      <div class="row">
                      <div class="col-sm-4 mb-2">
                      <label for="exampleInputEmail1">Jenis Satuan Bahan</label>
                      {{-- <input type="text" class="form-control" name="satuan" id="satuan" required> --}}
                      <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="Satuan"
                      placeholder="Satuan" value="{{ old('satuan') }}" name="satuan" required>
                       @error('satuan')
                      <div class="invalid-feedback"> {{ $message }}</div>
                      @enderror
    
                      </div>
                      {{-- <div class="col-sm-4 mb-2">
                        <label for="exampleInputEmail1">QTY</label>
                        <input type="text" class="form-control" name="qty" id="satuan" required>
                        </div> --}}
                      <div class="col-sm-4 mb-2">
                        <label for="exampleInputEmail1">Harga</label>
                        {{-- <input type="text" class="form-control" name="harga" id="satuan" required> --}}


                        <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga"
                        placeholder="Harga" value="{{ old('harga') }}" name="harga" required>
                         @error('harga')
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                        </div>
                      </div>
                      <div class="col-sm-4 mb-2">
                      <button type="submit" class="btn btn-primary mt-3">Tambah</button>
                      @if(session()->has('sukses'))
                      <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                        {{session('sukses')}}
                      </div>
                      @endif
                      </div>

                  </form>
                </div>
              </div>
            
          
        
          </div>
        </div>
        </main>
        @endsection