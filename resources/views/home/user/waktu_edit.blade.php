
        @extends('layout/main')
        @section('container')
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Waktu Makan</h1>
            
          
           
            <div class="row">
              <div class="col-xl-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    <strong> Edit Waktu  </strong>
                  </div>
                  <div class="kembali">
                    <i class="fas fa-arrow-left"></i><a href="/waktu"> Kembali</a>
                  </div>
                  <form method="POST" action="{{route('updatewa',$waktu['id'])}}">
                    @csrf
                    <div class="form-group p-2">
                      <label for="exampleInputEmail1">Masukkan nama waktu</label>
                      <input type="text" class="form-control" name="nama_waktu" id="nama_waktu"  value="{{$waktu['nama_waktu']}}" required>
          

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