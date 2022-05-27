

      
      @extends('layout/main')
      @section('container')
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Ubah BOP</h1>
          
        
         
          <div class="row">
            <div class="col-xl-12">
              <div class="card">
                <div class="card-header">
                  <i class="fas fa-warehouse"></i>
                  Edit Garnitures & other
                </div>
           
                <form method="POST" action="{{route('updatebo',$bo1['id'])}}">
                  @csrf
      
                  <div class="form-group p-3">
                    <div class="mb-2">
                      <h4 class="">Garnitures & other</h4>
                    </div>
                    @if(session()->has('suksesedit'))
                    <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                      {{session('suksesedit')}}
                    </div>
                    @endif
                    {{-- <input type="hidden" class="form-control" name="nama_bop" value="{{$bo1->nama_bop}}" > --}}
                      <div class="form-group mb-2">
                        <label for="exampleFormControlTextarea1">Keterangan</label>
                        {{-- <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" required rows="3">{{$bo1->keterangan}}</textarea> --}}
                        <textarea  class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                        placeholder="Keterangan" value="{{ old('keterangan') }}" name="keterangan" id="exampleFormControlTextarea1" rows="3" required >{{$bo1->keterangan}}</textarea>
                         @error('keterangan')
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                      </div>
                      <div class="col-1 mb-2">
                        <label for="exampleInputEmail1">Besaran %</label>
             
                        <input type="text" class="form-control @error('besaran') is-invalid @enderror" id="besaran"
                        placeholder="Nama Bahan"value="{{$bo1->besaran}}" name="besaran" required>
                         @error('besaran')
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </div>

              
                

                </form>
              </div>
              
      
        </div>
        <div class="row">
          <div class="col-xl-12 mt-3">
            <div class="card">
              <div class="card-header">
                <i class="fas fa-warehouse"></i>
                Edit Sales Price 
              </div>
         
              <form method="POST" action="{{route('updatebo2',$bo2['id'])}}">
                @csrf
    
                <div class="form-group p-3">
                  <div class="mb-2">
                    <h4 class="">Sales Price</h4>
                  </div>
                  @if(session()->has('suksesedit2'))
                  <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                    {{session('suksesedit2')}}
                  </div>
                  @endif
                    <div class="form-group mb-2">
                      <label for="exampleFormControlTextarea1">Keterangan</label>
                      <textarea  class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                      placeholder="Keterangan" value="{{ old('keterangan') }}" name="keterangan" id="exampleFormControlTextarea1" rows="3" required >{{$bo2->keterangan}}</textarea>
                       @error('keterangan')
                      <div class="invalid-feedback"> {{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-1 mb-2">
                      <label for="exampleInputEmail1">Besaran %</label>
                      {{-- <input type="text" class="form-control" name="besaran" id="besaran" value="{{$bo2->besaran}}" required> --}}
                      <input type="text" class="form-control @error('besaran') is-invalid @enderror" id="besaran"
                      placeholder="Nama Bahan"value="{{$bo2->besaran}}" name="besaran" required>
                       @error('besaran')
                      <div class="invalid-feedback"> {{ $message }}</div>
                      @enderror
                      </div>
                  <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                 
              

              </form>
            </div>
            
    
      </div>
        
      </div>
          </div>
      </main>
      @endsection