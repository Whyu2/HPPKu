
        @extends('layout/main')
        @section('container')
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Kategori</h1>
            
          
           
            <div class="row">
              <div class="col-xl-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    <strong> Edit kategori  </strong>
                  </div>
                  <div class="kembali">
                    <i class="fas fa-arrow-left"></i><a href="/kategori"> Kembali</a>
                  </div>
                  <form method="POST" action="{{route('updatek',$kategori['id'])}}">
                    @csrf
                    <div class="form-group p-2">
                      <label for="exampleInputEmail1">Masukkan nama kategori</label>
                   
          
                      <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori"
                      placeholder="Nama Kategori"  name="nama_kategori"  value="{{$kategori['nama_kategori']}}" required>
                       @error('nama_kategori')
                      <div class="invalid-feedback"> {{ $message }}</div>
                      @enderror
                      <button type="submit" class="btn btn-primary mt-3">Submit</button>
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