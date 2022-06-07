
        @extends('layout/main')
        @section('container')
            {{-- pemanggilan function dari model --}}
          
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Cetak Event Order</h1>
            
            <div class="row">
     
          <div class="col-xl-12">
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-file-contract"></i>
                <strong>   List Event Order</strong>
              </div>
              <div class="card-body">
                <table id="datatablesSimple">
             
                 <div class="row  ">
                   
                  <div class="col-3 mb-2">
                    <label for="exampleInputEmail1">Pilih tanggal event</label>
                  </div>
                  <form action="/cetak_event/select" method="POST">
                    @csrf
                  <div class="row  mb-2">
                    <div class="col-2 ">
               
                      <label for="exampleInputEmail1 "> <i class="fas fa-calendar-alt"></i> Mulai</label>
                      <input class="date form-control" id="tglmulai" name="tglmulai" type="text" value="{{$mulai}}">
         
                    {{-- <button class="btn btn-success add-more" type="button"><i class="fas fa-plus"></i></button> --}}
                  </div>
                  <div class="col-1 mt-4 text-center">
                    <i class="fas fa-arrow-right fa-2x"></i>
                    </div>
                  <div class="col-2 ">
                    <label for="exampleInputEmail1 "> <i class="fas fa-calendar-alt"></i> Selesai</label>
                    <input class="date form-control" id="tglselesai" name="tglselesai" type="text" value="{{$selesai}}">
                </div>
                <div class="row">
                  <div class="col-8 mt-2  ">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </div>
                  </div>
                    </div>
                  </form>
                 
                  </div>
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Event</th>
                      <th>KD Event</th>
                      <th>Tanggal</th>
                      <th>Lama</th>
                      <th>Porsi/Pax</th>
                      <th>Penjualan</th>
                      <th>Biaya Produksi</th>
                      <th>Revenue</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama Event</th>
                      <th>KD Event</th>
                      <th>Tanggal</th>
             <th>Lama</th>
             <th>Porsi/Pax</th>
                      <th>Penjualan</th>
                      <th>Biaya Produksi</th>
                      <th>Revenue</th>
                    
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $number=1; ?>
                    @foreach ($list as $key => $lists)
                    <tr>
                    <td>{{$number}}</td>
              
                    <td><a href="{{route('detaile',$lists['id'])}}">{{$lists['nama_event']}}</a></td>
                    <td>{{$lists['kd_event']}}</td>
                    <td>
                      @if($lists['tgl_mulai'] == $lists['tgl_selesai'] )
                      {{formatDate($lists['tgl_mulai'])}}
                      @else
                      {{formatDate($lists['tgl_mulai'])}} - {{formatDate($lists['tgl_selesai'])}} 
                      @endif
                    </td>
                    @php
                   $lama = $event->lamaevent($lists['tgl_mulai'],$lists['tgl_selesai']);
                  $tot_jual = $event->tot_jual( $lists['h_jual_p'],$lists['porsi']);  
                             
                    @endphp
                    <td>{{$lama}} Hari</td>
                    <td  class="text-center">{{$lists['porsi']}}</td>
                    <td  class="text-center">{{formatIDR($tot_jual)}}</td>
                    <td  class="text-center">{{formatIDR($lists['total_produksi'])}}</td>
           
                    <td>{{formatIDR($lists['revenue'])}}</td>
                    <?php $number++; ?>
                    </tr>
                    @endforeach
                  </tbody>
                  
                </table>
           
                
                  <div class="row  mb-2">
                   
                  <div class="col-10  ">
                  
                    
                  </form>
                  
                
                    </div>
                   
                     
                    <div class="col-2 text-right ">
                      @if ($mulai==null & $selesai==null)
                      <a href="{{route('print_event')}}" target"_blank" class="btn btn-success float-right"><i class="fas fa-print"></i> Cetak</a>
                    @else
                    <form action="/cetak_event/print_select" method="POST">
                      @csrf
                      <input type="hidden" name="tglmulai" value="{{$mulai}}">
                      <input type="hidden" name="tglselesai" value="{{$selesai}}">
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-print"></i> Cetak</button>
                  </form>
                    @endif
                    
              
                      </div>
                      
                      
                    </div>
                 
                
              </div>


          </div>

              </div>





        














        

        </main>
  
        @endsection