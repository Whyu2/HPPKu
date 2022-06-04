
        @extends('layout/main')
        @section('container')
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Event Order</h1>
            
            <div class="row">
    
              <div class="col-xl-8">
                <div class="card mb-4">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-9 "><i class="fas fa-mortar-pestle"></i> <strong>Masukkan Detail Event Makanan</strong></div>
                      <div class="col-md-3 "><i class="far fa-calendar-alt"></i> <label>{{formatDate($date)}}</label></div>
                    </div>
                   
                  </div>
                  <div class="card-body">
            
                   
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
                    
                  <div class="row">
                    <div class="col-12 ">
                      <h3> Deskripsi Event </h3>
                    </div>
                    <div class="col-3 mb-2 ">
                      <label for="exampleInputEmail1">Kode Event</label>
                      <input type="text" class="form-control" id="kd_event" name="kd_event"  value="{{$addkode->event}}" readonly>
                      </div>
              
                    <div class="col-3 ">
               
                        <label for="exampleInputEmail1 "> <i class="fas fa-calendar-alt"></i> Mulai</label>
                        <input class="date form-control" id="tglmulai" name="tgl" type="text">
           
                      {{-- <button class="btn btn-success add-more" type="button"><i class="fas fa-plus"></i></button> --}}
                    </div>
                    <div class="col-1 mt-4 text-center">
                      <i class="fas fa-arrow-right fa-2x"></i>
                      </div>
                    <div class="col-3 ">
               
                      <label for="exampleInputEmail1 "> <i class="fas fa-calendar-alt"></i> Selesai</label>
                      <input class="date form-control" id="tglselesai" name="tgl" type="text">
                
          
                  </div>
                    <div class="row">
              
                      <div class="col-4 mb-2">
                        <label for="exampleInputEmail1">Waktu Makanan</label>
                        <select class="form-select" name="id_waktu" id="waktu"  aria-label="Default select example">
                          <option selected>Pilih Waktu</option>
                          @foreach ($waktu as $wa)
                          <option value="{{$wa->id}}">{{$wa->nama_waktu}}</option>
                          @endforeach
                        </select>
                        </div>
                        <div class="row">

                     
                        <div class="col-8 mb-2  ">
                          <label for="exampleInputEmail1 mb-2">Nama Event</label>
                          <input type="text" class="form-control" name="nama_event" id="nama"  placeholder="Masukkan Nama Event" required>
                          </div>
                        </div>
                    </div>


                    {{-- <div class="col-7 mt-3">
                      <label class="font-weight-bold" >Nama Makanan :
                      <input type="text" class="form-control" id="outmakan" name="" readonly>
                    </div> --}}
  
                  </div>

                  <div class="row">
         
                      <div class="col-12 mt-3 ">
                        <h3> Pilih makanan </h3>
                      </div>
                  </div>
            
                  <form action="/event/store" method="POST">
                    @csrf
                    <input type="hidden" id="outwaktu" name="id_waktu">
                    <input type="hidden" id="outnama" name="nama_event">
                    <input type="hidden" id="outtglmulai" name="tgl_mulai">
                    <input type="hidden" id="outtglselesai" name="tgl_selesai">
                    <div class="control-group  after-add-more">
                      <div class="row">
                        <div class="col-sm-7">
                       <label>Menu yang tersedia</label>
                       <select class="form-select" name="hpp_id[]" aria-label="Default select example" required >
                        <option value=""  selected>Pilih Menu</option>
                        <?php $number = 1; ?>
                        @foreach ($hpp as $key => $h)
                        <option value="{{$h->id}}">{{ $number }}. {{$h->makanan->nama_makanan}} | <b>HPP</b> {{formatIDR($h->total_hpp)}}</option>
                        <?php $number++; ?>
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
                       <input type="number" id="replyNumber" min="0" data-bind="value:replyNumber"  name="qty[]" class="form-control" id="qty" required>
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
                     <div class="col mt-3">
                     <button class="btn btn-primary" type="submit">Simpan</button>
                     </div>
                   </form>
           
                   <!-- class hide membuat form disembunyikan  -->
                   <!-- hide adalah fungsi bootstrap 3, klo bootstrap 4 pake invisible  -->
                   <div class="copy invisible">
                 
                       <div class="control-group hpp  ">
                        <div class="row">
                          <div class="col-sm-7">
                            <label>Menu yang tersedia</label>
                             <select class="form-select" name="hpp_id[]" aria-label="Default select example" required >
                                  <option value=""  selected>Pilih Menu</option>
                                  <?php $number = 1; ?>
                                  @foreach ($hpp as $key => $h)
                                   <option value="{{$h->id}}">{{ $number }}. {{$h->makanan->nama_makanan}} | <b>HPP</b> {{formatIDR($h->total_hpp)}}</option>
                                   <?php $number++; ?>
                                @endforeach
                             </select>
                             </div>
                             <div class="col-sm-2">
                            <label>QTY</label>
                            <input type="number" id="replyNumber" min="0" data-bind="value:replyNumber"  name="qty[]" class="form-control" id="qty" required>
                            
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




                
              </div>

                <div class="col-xl-12">
                  <div class="card mb-4">
                    <div class="card-header">
                      <i class="fas fa-calculator"></i>
                      <strong>   List Event</strong>
                    </div>
                 
                   
                  
                 
                    <div class="card-body">
                      @if(session()->has('hapus'))
                      <div class="alert alert-danger allert-dismissible fade show mt-1 p-2" role="alert">
                        {{session('hapus')}}
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
                            <th>Kode</th>
                            <th>Nama Event</th>
                            <th>Waktu</th>
                            <th>Jumlah Menu</th>
                            <th>Jumlah Porsi</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Kode</th>
                       
                            <th>Nama Event</th>
                            <th>Waktu</th>
                            <th>Jumlah Menu</th>
                            <th>Jumlah Porsi</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                          </tr>
                        </tfoot>
                        <tbody>
            

                          <?php $number=1; ?>
                          @foreach ($list as $key => $lists)
                              <tr>
                                <td>{{$lists->kd_event}}</td>
                                <td ><a href="{{route('detaile',$lists->id)}}">{{$lists->nama_event}}</a></td>
                                <td >{{$lists->waktu->nama_waktu}}</td>
                               @php
                                $jmlh_menu = $eveent_makanan->jumlahmenu($lists->id);
                               @endphp
                                <td class="text-center">{{$jmlh_menu->total}}</td>
                                <td class="text-center">{{$lists->total_porsi}}</td>
                                <td class="">{{formatDate($lists->tgl_mulai)}}</td>
                                <td class="">{{formatDate($lists->tgl_selesai)}}</td>
                                <?php $number++; ?>
                              </tr>
                              @endforeach

                   
                        </tbody>
                      </table>
                     
                    </div>


                </div>
     
        
      
              </div>

        </main>
  
        @endsection