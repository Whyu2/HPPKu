
      @extends('layout/main')
      @section('container')
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Ubah Cost</h1>
          
        
         
          <div class="row">
            <div class="col-xl-10">
              <div class="card mb-4">
                <div class="card-header">
                  <i class="fas fa-money-bill"></i>
                  Ubah Cost Percentace  
                </div>
                
            
                <form method="POST" action="{{route('updatec',$c['id'])}}">
                  @csrf
                 
                  <div class="form-group p-3">
                    <div class="mb-2">
                      <h4 class="">Cost Percentace</h4>
                    </div>
                    @if(session()->has('suksesedit'))
                    <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                      {{session('suksesedit')}}
                    </div>
                    @endif
                    <div class="mb-2">
               
           
                    

                    </div>
                        <div class="form-group mb-2">
                        <label for="exampleFormControlTextarea1">Keterangan</label>

                        <textarea  class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                        placeholder="Keterangan" value="{{ old('keterangan') }}" name="keterangan" id="exampleFormControlTextarea1" rows="3" required >{{$c->keterangan}}</textarea>
                         @error('keterangan')
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                      </div>
                      <div class="col-3 mb-2">
                        <label for="exampleInputEmail1">Besaran (%)</label>
                        <div class="row">
                       
                          <div class="col-7">
                        <input type="text" class="form-control @error('besaran') is-invalid @enderror" id="besaran"
                        placeholder="Besaran"value="{{$c->besaran}}" name="besaran" >
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