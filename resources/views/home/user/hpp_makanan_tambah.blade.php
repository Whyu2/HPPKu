
        @extends('layout/main')
        @section('container')
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">HPP Permakanan</h1>
            
            <div class="row">
              @if (auth()->user()->level == "user")
              <div class="col-xl-7">
                <div class="card mb-4">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-9 text-dark"><i class="fas fa-mortar-pestle"></i> <strong>Detail Makanan</strong></div>
                      <div class="col-md-3 text-dark"><i class="far fa-calendar-alt"></i> <label>{{formatDate($date)}}</label></div>
                    </div>
   
  
                  
                  </div>
                  <div class="row">
                  
                    <div class="col-8 mt-3  kembali">
                      <label class="font-weight-bold" >Kode Makanan :
                        <select class="form-select"  id="makanan" name="kd_makanan"   aria-label="Default select example" required="required">
                        
                        <option value="" selected>Pilih Makanan</option>
                        @foreach ($makanan as $m)
                        <option value="{{$m->id}}">{{$m->kd_makanan}} - {{$m->nama_makanan}} </option>
                        @endforeach
                      </select>
                      @error('kd_makanan')
                      <div class="invalid-feedback d-block">
                   Kode makanan harus dipilih
                      </div>
                      @enderror
                    </label> 
                      {{-- <button class="btn btn-success add-more" type="button"><i class="fas fa-plus"></i></button> --}}
                    </div>
                    {{-- <div class="col-7 mt-3">
                      <label class="font-weight-bold" >Nama Makanan :
                      <input type="text" class="form-control" id="outmakan" name="" readonly>
                    </div> --}}
                   
                  </div>
            
                  <form action="/hpp/store" method="POST">
                    @csrf
                    <input type="hidden" id="outmakanan" name="kd_makanan">
                    <div class="control-group kembali after-add-more">
                      <div class="row">
                        <div class="col-sm-7">
                       <label>Bahan Baku</label>
                       <select class="form-select" name="kd_bahan[]" aria-label="Default select example" required >
                        <option selected>Pilih Bahan</option>
                        @foreach ($bahan as $b)
                        <option value="{{$b->id}}">{{$b->kd_bahan}} - {{$b->nama_bahan}} <p class="text-center">{{formatIDR($b->harga)}}/{{$b->satuan}}</p></option>
                        @endforeach
                      
                      </select>
                      @error('kd_bahan[]')
                      <div class="invalid-feedback d-block">
                   Bahan baku harus dipilih
                      </div>
                      @enderror
                        </div>
                        <div class="col-sm-2">
                       <label>QTY</label>
                       <input type="text" name="qty[]"  class="form-control" @error('qty[]') is-invalid @enderror id="qty" required >
                          @error('qty[]')
                          <div class="invalid-feedback d-block">
                          Jumlah QTY harus disi
                          </div>
                          @enderror
                   
   
                        </div>
                        <div class="col-sm-3 mt-4">
                       
                          <button class="btn btn-success add-more" type="button"><i class="fas fa-plus"></i></button>
                           </div>
                      
                      </div>
                      </divd>
                     </div>
                     <div class="col p-3">
                     <button class="btn btn-primary" type="submit">Simpan</button>
                     </div>
                   </form>
           
                   <!-- class hide membuat form disembunyikan  -->
                   <!-- hide adalah fungsi bootstrap 3, klo bootstrap 4 pake invisible  -->
                   <div class="copy invisible">
                 
                       <div class="control-group hpp kembali ">
                        <div class="row">
                          <div class="col-sm-7">
                            <label>Bahan Baku</label>
                            <select class="form-select" name="kd_bahan[]" aria-label="Default select example" required>
                              <option value="" selected>Pilih Makanan</option>
                             @foreach ($bahan as $b)
                             <option value="{{$b->id}}">{{$b->kd_bahan}} - {{$b->nama_bahan}} <p class="text-center">{{formatIDR($b->harga)}}/{{$b->satuan}}</p></option>
                             @endforeach
                           </select>
                             </div>
                             <div class="col-sm-2">
                            <label>QTY</label>
                            <input type="text" name="qty[]" class="form-control" id="qty" required>
                            
                             </div>
                             {{-- <div class="col-sm-2 mt-4">
                              <div id="out2">
                                <input class="form-control" type="text" name="kd_makanan[]">
                              </div>
                          
                              <select class="form-select" name="kd_makanan[]" id="out" ></select>
                             </div>
                             --}}
                                     <div class="col-sm-3 mt-4">
                       
                                      <button class="btn btn-danger remove" type="button"><i class="fas fa-trash-alt"></i></button>
                                       </div>
                                      
                       </div>
                       </div>
                     </div>
                   </div>
                
                </div>



                <div class="col-xl-5">
                  <div class="card mb-4">
                    <div class="card-header">
                      <i class="fas fa-calculator"></i>
                      <strong>   List HPP</strong>
                    </div>
                 
                   
                  
                 
                    <div class="card-body">
                      @if(session()->has('hapus'))
                      <div class="alert alert-danger allert-dismissible fade show mt-1 p-2" role="alert">
                        {{session('hapus')}}
                      </div>
                      @endif
                      @if(session()->has('tambah'))
                      <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                        {{session('tambah')}}
                      </div>
                      @endif
                      @if(session()->has('suksesedit'))
                      <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                        {{session('suksesedit')}}
                      </div>
                      @endif
                      <table id="datatablesSimple">
                        @if(session()->has('sukses'))
                        <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                          {{session('sukses')}}
                        </div>
                        @endif
                        <thead>
                          <tr>
                            <th>No</th>
                            
                            <th>KD makanan</th>
                            <th>Nama</th>
                            <th>Harga Produksi</th>
                          
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>No</th>
                            <th>KD makanan</th>
                            <th>Nama</th>
                            <th>Harga Produksi</th>
                          </tr>
                        </tfoot>
                        <tbody>
                      <?php $number=1; ?>
                      @foreach ($list as $key => $lists)
                          <tr>
                            <td>{{$number}}</td>
                            <td>{{$lists->makanan->kd_makanan}}</td>
                            <td><a href="{{route('detail',$lists->makanan_id)}}">{{$lists->makanan->nama_makanan}}</a></td>
                            <td>{{formatIDR($lists->total_hpp)}}</td>
                            <?php $number++; ?>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                     
                    </div>


                </div>
          @endif
          @if (auth()->user()->level == "admin")
          <div class="col-xl-12">
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-calculator"></i>
                <strong>   List HPP</strong>
              </div>
           
             
            
           
              <div class="card-body">
                @if(session()->has('hapus'))
                <div class="alert alert-danger allert-dismissible fade show mt-1 p-2" role="alert">
                  {{session('hapus')}}
                </div>
                @endif
                @if(session()->has('tambah'))
                <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                  {{session('tambah')}}
                </div>
                @endif
                @if(session()->has('suksesedit'))
                <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                  {{session('suksesedit')}}
                </div>
                @endif
                <table id="datatablesSimple">
                  @if(session()->has('sukses'))
                  <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                    {{session('sukses')}}
                  </div>
                  @endif
                  <thead>
                    <tr>
                      <th>No</th>
                      
                      <th>KD makanan</th>
                      <th>Nama</th>
                      <th>Harga Produksi</th>
                    
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      
                      <th>KD makanan</th>
                      <th>Nama</th>
                      <th>Harga Produksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
                <?php $number=1; ?>
                @foreach ($list as $key => $lists)
                    <tr>
                      <td>{{$number}}</td>
                      <td>{{$lists->makanan->kd_makanan}}</td>
                      <td><a href="{{route('detail',$lists->makanan_id)}}">{{$lists->makanan->nama_makanan}}</a></td>
                      <td>{{formatIDR($lists->total_hpp)}}</td>
                      <?php $number++; ?>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
               
              </div>


          </div>
          @endif
              </div>





        














        

        </main>
  
        @endsection