
      @extends('layout/main')
      @section('container')
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Ubah BTKL</h1>
          
        
         
          <div class="row">
            <div class="col-xl-10">
              <div class="card mb-4">
                <div class="card-header">
                  <i class="fas fa-people-carry"></i>
                  Ubah Biaya Tenaga Kerja Langsung 
                </div>
            
                <form method="POST" action="{{route('updatebt',$bt['id'])}}">
                  @csrf
              
                  <div class="form-group p-3">
                    @if(session()->has('suksesedit'))
                    <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                      {{session('suksesedit')}}
                    </div>
                    @endif
                    <div class="mb-2">
                    <label for="exampleInputEmail1">Nama pekerja </label>
           
                    
                    <input type="text" class="form-control @error('nama_btkl') is-invalid @enderror" id="nama_btkl"
                    placeholder="Nama BTKL"value="{{$bt->nama_btkl}}" name="nama_btkl" required>
                     @error('nama_btkl')
                    <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                    </div>
                        <div class="form-group mb-2">
                        <label for="exampleFormControlTextarea1">Keterangan</label>

                        <textarea  class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                        placeholder="Keterangan" value="{{ old('keterangan') }}" name="keterangan" id="exampleFormControlTextarea1" rows="3" required >{{$bt->keterangan}}</textarea>
                         @error('keterangan')
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                      </div>
                      <div class="col-3 mb-2">
                        <label for="exampleInputEmail1">Besaran (/PCS)</label>
                        <div class="row">
                          <div class="col-1 kembali">
                            <label><b>Rp</b></label>
                          </div>
                          <div class="col-7">
                        <input type="text" class="form-control @error('besaran') is-invalid @enderror" id="besaran"
                        placeholder="Besaran"value="{{$bt->besaran}}" name="besaran" >
                         @error('besaran')
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                        </div>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                      </div>

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
      </main>
      @endsection