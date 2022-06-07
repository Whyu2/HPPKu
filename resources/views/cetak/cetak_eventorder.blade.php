
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}"/> 
    <title></title>
   
    <link
      href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css"
      rel="stylesheet"
    />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link href="{{asset('css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script
      crossorigin="anonymous" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
    ></script>

    {{--date --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


  </head>
<body onload="window.print();">
  @php
  $tot_menu = $eveent_makanan->jumlahmenu($detail->id);

  $grost_profit = $event->grost($detail->total_jual,$detail->total_produksi);
  @endphp
<div class="wrapper mt-3">
  <!-- Main content -->
    <!-- title row -->
    <div class="container">
        <div class="row ">
            <div class="col-12 mx-auto">
              <div class="card  mb-4 ">
                        <div class="row">  
                            <div class="col-6 ">
                                <div class="row">
                               
                                    <div class="col-8 kembali">
                                      <label>Hotel Sahid Solo</label>
                                      <h4><b>{{$detail->nama_event}}</b></h4>
                                    </div>
                                    <div class="col-8 kembali">
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
                                
                                </div>
                            </div>
                            <div class="col-6 mt-4 mx-auto">
                              <img src="{{asset('img/logo.jpg')}}" class="rounded mx-auto d-block" alt="...">
                            </div>
            
              

                </div>
                <div class="row">
                  <div class="col mt-3  kembali">
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

        
        
        </div>
      </div>
    <!-- info row -->
   
    <!-- /.row -->

    <!-- Table row -->
 
    <!-- /.row -->

   
    <!-- /.row -->

  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
