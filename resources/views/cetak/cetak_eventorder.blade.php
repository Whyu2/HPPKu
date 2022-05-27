
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
  $tot_qty = $eveent_makanan->totalqty($detail->id);
  $tot_hpp = $eveent_makanan->totalhpp($detail->id);
  $tot_jual = $eveent_makanan->totalqtyjual($detail->id);
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
                                            <tr><th>Tanggal Event</th><th>  : </th><td>{{formatDate($detail->tgl_mulai)}} - {{formatDate($detail->tgl_selesai)}} </td></tr>
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
                                <td>{{$event_makanan['nama_makanan']}}</td>
             
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
                                  <td width="180px"><b>Total Jual</b> ({{$lama}}hari)</td>
                                  
                                  <td width="10px">:</td>
                       
                                  <td>{{$detail->total_jual}}</td>
                                  <td></td>
                                  
                                </tr>
                                <tr>
                                  <td width="180px"><b>Total HPP</b> ({{$lama}}hari)</td>
                                  <td width="10px">:</td>
                                  <td>{{$detail->total_produksi}}</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td width="180px"><hr></td>
                                </tr>
                                <tr>
                                  <td width="180px"><b>Margin Kontribusi</b></td>                           
                                  <td width="10px">:</td>
                                  <td>{{$grost_profit}}</td> 
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                           
                                </tr>
                                <tr>
                                  <td width="180px"><b>Gross Profit</b></td>                             
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
