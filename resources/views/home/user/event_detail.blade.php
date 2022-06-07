
        @extends('layout/main')
        @section('container')
        {{-- pemanggilan function dari model --}}
        @php
        $tot_menu = $eveent_makanan->jumlahmenu($detail->id);
    
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
                                            <tr><th>Jumlah Pax/Porsi </th><th>  : </th><td>{{$detail->porsi}} </th><td> </td></tr>
                                            <tr><th>Tanggal Event</th><th>  : </th><td>
                                              @if($detail->tgl_mulai == $detail->tgl_selesai )
                                              {{formatDate($detail->tgl_mulai)}}
                                              @else
                                              {{formatDate($detail->tgl_mulai)}} - {{formatDate($detail->tgl_selesai)}} </td></tr>
                                              @endif
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
                              <th rowspan="2"  class=" text-center">NAMA MENU & BAHAN</th>
                              <th rowspan="2"  class=" text-center">SATUAN</th>
                              <th rowspan="2"  class=" text-center">QTY</th>
                              <th colspan="3" class=" text-center">PERIODE BAHAN : </th>
                            </tr>
                            <tr>
                              <th  class=" text-center">Harga Satuan <br> (Dalam Rp)</th>
                              <th  class=" text-center">Total <br> (Dalam Rp)</th>
                            </tr>
                            
                           
                  
                            
                            @foreach ($hpps as $key => $event_makanan)
                                <tr>
                                 
                                  <th colspan="5"><a href="{{route('detail',$event_makanan->hpp->makanan->id)}}">{{$event_makanan->hpp->makanan->nama_makanan}}</a> 
                                    <?php 
                                   $qty = $event_makanan->qty ;
                                      $listbahan = $resep->listbahan($event_makanan->hpp->makanan->id);  
                                      ?>
                                
                                       @foreach ($listbahan as $k => $e)
                                    
                                      <tr>
                                    @php 
                                    $tot_qty = $eveent_makanan->total_qty($e->bahan->id, $qty);
                               
                                  @endphp
                                     <td > <?= str_repeat('&nbsp;', 3); ?> {{$e->bahan->nama_bahan}}</td>
                                     <td  class="text-center">{{$e->bahan->satuan}}</td>
                                     <td  class="text-center">{{$tot_qty}}</td>
                                     <td  class="text-center" >{{$e->bahan->harga}}</td>
                                     @php 
                                     $tot_bahan_qty = $hpp->bahanqty($tot_qty,$e->bahan->harga );
                                   @endphp
                                     <td  class="text-center">{{$tot_bahan_qty}}</td>
                                  </tr>                    
                               @endforeach 
                              </th>
                                </tr>
                     
                          @endforeach 
                        
                          <tr>
                            <th colspan="3">Total Bahan</th>
                            <td  class=" text-center"></td>

                      
                            <th  class=" text-center">{{$detail->total_bahan}}</th>
                          </tr>
                          <tr>
                            <td colspan="3">{{$btkl->nama_btkl}}/PCS</td>
                            <td  class=" text-center"></td>
                            <td  class=" text-center">{{$btkl->besaran}}</td>
                          </tr>
                          <tr>
                            <th colspan="3" >Total BTKL</th>
                            <td  class="text-center"></td>
                            <th  class=" text-center">{{$detail->total_btkl}}</th>
                          </tr>
                          <tr>
                            <td colspan="3">{{$bop->nama_bop}} {{$bop->besaran}} %</td>
                            <td  class=" text-center"></td>
                            <td  class=" text-center">{{$detail->total_bop}}</td>
                          </tr>
                    
                          <tr>
                            <th colspan="3">Total Overhead</th>
                            <td  class=" text-center"></td>
                            <th  class=" text-center">{{$detail->total_bop}}</th>
                          </tr>
                          <tr>
                            <th colspan="3">Harga Pokok Produksi</th>
                            <td  class=" text-center"></td>
                            <th class=" text-center">{{$detail->total_produksi}}</td>
                          </tr>
                          <tr>
                            <td colspan="3"> <b>Harga Jual Perporsi</b> (HPP / Cost Precentace * 1,21) <br>
                            </td>
                            <td  class=" text-center"></td>
                            <th class=" text-center">{{$detail->h_jual_p}}</td>
                          </tr>
                               
                              </tbody>
                        </table>
                        <table class="table table-bordered ">
                        <thead>
                          <tr>
                            <td ><b>Rincian </b><br><br>
                              <table class="table table-borderless">
                                @php 
                                $tot_jual = $event->tot_jual( $detail->h_jual_p,$detail->porsi);  
                                $rev_day = $tot_jual - $detail->total_produksi;
                                  @endphp             
                                <tr>
                                  <td width="350px"><b>Total Jual </b>({{$detail->h_jual_p}} * {{$detail->porsi}} Pax)</td>
                                  
                                  <td width="10px">:</td>
                           
                                  <td  width="350px">{{$tot_jual}}</td>
                                  <td></td>
                                  
                                </tr>
                                <tr>
                                  <td width="150px"><b>Total HPP</b> </td>
                                  <td width="10px">:</td>
                       
                             
                                  <td  width="350px">{{$detail->total_produksi}}</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td width="10px"><hr></td>
                                </tr>
                            
                                <tr>
                                  <td width="150px"><b></b></td>       
                                     
                                  <td width="10px"></td>
                                  <td width="">{{$rev_day}}</td>
                                  <td></td>
                           
                                </tr>
                                <tr>
                                  <td width="150px"><b>Revenue Hotel</b> ({{$rev_day}} * {{$lama}}Hari) </td>       
                                     
                                  <td width="10px">:</td>
                                  <td width=""><b>{{formatIDR($detail->revenue)}}</b></td>
                                  
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