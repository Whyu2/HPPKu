
        @extends('layout/main')
        @section('container')
        {{-- pemanggilan function dari model --}}
        @php
        $tot_menu = $eveent_makanan->jumlahmenu($detail->id);
        $tot_qty = $eveent_makanan->totalqty($detail->id);
        $tot_hpp = $eveent_makanan->totalhpp($detail->id);
        $tot_jual = $eveent_makanan->totalqtyjual($detail->id);
        $grost_profit = $event->grost($detail->total_jual,$detail->total_produksi);
        @endphp
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">HPP</h1>
            <div class="row" >
                <div class="col-md-12">
                  <div class="card  mb-4 ">
                    <div class="card-header bg-dark">
                  
            
                         
                        <div class="row">
                          <div class="col-md-9 text-white"> <strong>Detail Event</strong></div>
                          <div class="col-md-3 text-white"><i class="far fa-calendar-alt"></i> <label>{{formatDate($detail->created_at)}}</label></div>
                        </div>
                   
                         </div>
                  <div class="row">
                    <div class="kembali">
                      <i class="fas fa-arrow-left"></i><a href="/event"> Kembali</a>
                    </div>
                  </div>
                            <div class="row">  
                                <div class="col-md-6 mb-3">
                                    <div class="row">
                                   
                                        <div class="col-md-12 kembali">
                                          <label>Hotel Sahid Solo</label>
                                          <h4><b>{{$detail->nama_event}}</b></h4>
                                        </div>
                                        <div class="col-md-12 kembali">
                                          <table>
                                            <tbody>
                                            <tr><th>Kode Event </th><th>  : </th> <td>{{$detail->kd_event}}</td></tr>
                                            <tr><th>Waktu </th><th> : </th> <td>{{$detail->waktu->nama_waktu}}</td></tr>
                                            <tr><th>Jumlah Menu </th><th>  : </th><td>{{$tot_menu->total}} Menu</td></tr>
                                            <tr><th>Tanggal Event</th><th>  : </th><td>{{formatDate($detail->tgl_mulai)}} - {{formatDate($detail->tgl_selesai)}} </td></tr>
                                            <tr><th>Lama Event</th><th> : </th><td>{{$lama}} hari</td></tr>
                                            </tbody></table>
                                        </div>
                                        <div class="col-md-12 mt-5 kembali">
                                
                                            {{-- <label>Nama Makanan : <b></b></label> --}}
                               
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-4">
                                  <img src="{{asset('img/logo.jpg')}}" class="rounded mx-auto d-block" alt="...">
                                </div>
                
                  

                    </div>
                    <div class="row">
                      <div class="col mt-3 kembali">
                        <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                          <thead>
                            <tr>
                         
                              <th rowspan="2"  class=" text-center">NO</th>
                              <th rowspan="2"  class=" text-center">Nama Menu</th>
                              <th rowspan="2"  class=" text-center">Jumlah Porsi</th>
                          
                              <th colspan="2" class=" text-center">HPP</th>
                              <th colspan="2" class=" text-center">Harga Jual</th>  
                          
                            </tr>
                            <tr>
                     
                              <th  class=" text-center">Perporsi <br>(Dalam Rp)<br></th>
                              <th  class=" text-center">Total<br>  (Dalam Rp)<br></th>
                              <th  class=" text-center">Perporsi<br>  (Dalam Rp)<br> </th>
                              <th  class=" text-center">Total<br>  (Dalam Rp)<br></th>
                         
                            </tr>
                            
                           
                            <?php $number = 1; ?>
                            @foreach ($hpps as $key => $event_makanan)
                                <tr>
                                  <th class=" text-center">{{$number}}</th>
                                  <td><a href="{{route('detail',$event_makanan['id_makanan'])}}">{{$event_makanan['nama_makanan']}}</a></td>
               
                                  <td class=" text-center">{{$event_makanan['qty']}}</td>
                                  <td class=" text-center">{{$event_makanan['total_hpp']}}</td>
                                  <td class=" text-center">{{$event_makanan['hpp_qty']}}</td>
                                  <td class=" text-center">{{$event_makanan['total_jual']}}</td>
                                  <td class=" text-center">{{$event_makanan['jual_qty']}}</td>
                
                              
                                  <?php $number++; ?>

                                
                                </tr>
                          @endforeach 
                          <tr>
                            <th colspan="2">Total</th>
                            <th  class=" text-center">{{$tot_qty}}</th>
                            <td  class=" text-center"></td>
                            <th  class=" text-center">{{$tot_hpp}}</th>
                            <td  class=" text-center"></td>
                            <th  class=" text-center">{{$tot_jual}}</th>
                          </tr>
                               
                                
                   
             
                                
                   
                       
                         
                                
                              </tbody>
                        </table>
                        <table class="table table-bordered ">
                        <thead>
                          <tr>
                            <td ><b>Rincian </b><br><br>
                              <table class="table table-borderless">
                           
                                <tr>
                                  <td width="150px"><b>Total Jual</b> ({{$lama}}hari)</td>
                                  
                                  <td width="10px">:</td>
                       
                                  <td  width="350px"> {{$tot_jual}} * {{$lama}} = <b>{{$detail->total_jual}}</b></td>
                                  <td></td>
                                  
                                </tr>
                                <tr>
                                  <td width="150px"><b>Total HPP</b> ({{$lama}}hari)</td>
                                  <td width="10px">:</td>
                       
                                  
                                  <td  width="350px">{{$tot_hpp}} * {{$lama}}  = <b>{{$detail->total_produksi}}</b></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td width="150px"><hr></td>
                                </tr>
                                <tr>
                                  <td width="150px"><b>Margin Kontribusi</b></td>                           
                                  <td width="10px">:</td>
                                  <td><b>{{$grost_profit}}</b></td> 
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                           
                                </tr>
                                <tr>
                                  <td width="150px"><b>Gross Profit</b></td>                             
                                  <td width="10px">:</td>
                                  <td width=""><b>{{formatIDR($grost_profit)}}</b></td>
                                  
                                </tr>
                              </table>
                            </td>
                    
                             </tbody>
                        </table>
                        </div>
                      </div>
                    </div>
             
                   
                     </div>
                  
                  </div>
<div class="row">
  <div class="col-xl-3">
    <div class="card mb-4">
      <div class="card-header  bg-dark">
          <div class="row">
              <div class="col text-center text-white"></i> <strong>Cetak Data</strong></div>
          </div>
           </div>
            <div class="row mx-auto">
                <div class="col p-3">
                  <a href="{{route('cetak_detail_event',$detail->id)}}" target"_blank" class="btn btn-primary "><i class="fas fa-print fa-2x"></i></a>
                </div>
                <div class="col p-3">
                  <a href="{{route('cetak_eventorder_pdf',$detail->id)}}" target"_blank" class="btn btn-success "><i class="fas fa-file-pdf  fa-2x"></i></a>
                </div>
              {{-- <a href="{{route('deleteh',$detail->id)}}" class="btn btn-danger "><i class="fas fa-trash-alt fa-2x"></i></a> --}}
           </div>
           
           
           
       </div>
  </div>
        
                    <div class="col-xl-2">
                      <div class="card mb-4">
                        <div class="card-header bg-dark">
                            <div class="row">
                                <div class="col text-center text-white"></i> <strong>Hapus Data</strong></div>
                            </div>
                             </div>
                              <div class="row mx-auto">
                                  <div class="col p-3">
                                    <button type="button" value="{{$detail->id}}" class="btn btn-danger deletevent "><i class="fas fa-trash-alt fa-2x"></i></button>
                                  </div>
                              
                                {{-- <a href="{{route('deleteh',$detail->id)}}" class="btn btn-danger "><i class="fas fa-trash-alt fa-2x"></i></a> --}}
                       
                             </div>
                             
                             
                         </div>
                      </div>
            </div>
            </div>
          </div>
        </main>
  
        @endsection