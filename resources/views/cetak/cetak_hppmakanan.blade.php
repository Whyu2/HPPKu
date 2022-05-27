
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
  $tot_bahan = $resep->totalbahan($makanan_detail->id);
  $tot_garnitur = $hpp->totalgarnitur($makanan_detail->id);
  $tot_sales = $hpp->totalsales($makanan_detail->id);
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
                                      <h4><b>Resep Standar</b></h4>
                                    </div>
                                    <div class="col-8 kembali">
                                      <table>
                                        <tbody>
                                        <tr><td>Kode Makanan </td><td> : </td><td>{{$makanan_detail->kd_makanan}}</td></tr>
                                        <tr><td>Kategori </td><td> : </td><td>{{$makanan_detail->kategori->nama_kategori}}</td></tr>
                                        <tr><td>Jumlah Porsi </td><td> : </td><td>1 Porsi</td></tr>
                                        </tbody></table>
                                    </div>
                                    <div class="col-md-12 mt-5 kembali">
                            
                                        <label>Nama Makanan : <b>{{$makanan_detail->nama_makanan}}</b></label>
                           
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
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                     
                 
                          <th rowspan="2"  class=" text-center">BAHAN</th>
                          <th rowspan="2"  class=" text-center">SATUAN</th>
                          <th rowspan="2"  class=" text-center">QTY</th>
                          <th colspan="3" class=" text-center">PERIODE BAHAN : {{formatDatebulan($perioderesep->bahan->created_at)}}</th>
                        </tr>
                        <tr>
                          <th  class=" text-center">Harga Satuan <br> (Dalam Rp)</th>
                          <th  class=" text-center">Total <br> (Dalam Rp)</th>
                        </tr>
                        <thead>
                        <tbody> 
   
                        <?php $number=1; ?>
                        @foreach ($bahan_makanan as $key => $bahan_makanans)
                            <tr>
                              <td>{{$bahan_makanans['nama_bahan']}}</td>
                              <td  class=" text-center">{{$bahan_makanans['unit']}}</td>
                              <td class=" text-center">{{$bahan_makanans['qty']}}</td>
                              <td  class=" text-center">{{$bahan_makanans['price']}}</td>
                              @php 
                              $tot_bahan_qty = $hpp->bahanqty($bahan_makanans['qty'],$bahan_makanans['price'] );
                            @endphp
                            <td  class=" text-center">{{$tot_bahan_qty}}</td>
                              <?php $number++; ?>
                            </tr>
                            
               
                            @endforeach
                            <tr>
                              <th colspan="3">Total Bahan</th>
                              <td  class=" text-center">{{$tot_bahan}}</td>
                              <th  class=" text-center">{{($hpp_detail->total_bahan)}}</th>
                            </tr>
                            <tr>
                              <td colspan="3">{{$hpp_detail->btkl->nama_btkl}} {{formatIDR($hpp_detail->besaran_btkl)}}/PCS</td>
                              <td  class=" text-center"></td>
                              <td  class=" text-center">{{($btkl->besaran)}}</td>
                            </tr>
                            <tr>
                              <th colspan="3" >Total BTKL</th>
                              <td  class="text-center"></td>
                              <th  class=" text-center">{{$hpp_detail->total_btkl}}</th>
                            </tr>
                            <tr>
                              <td colspan="3">{{$bop->nama_bop}} ({{$hpp_detail->besaran_bop1}}%)</td>
                              <td  class=" text-center"></td>
                              <td  class=" text-center">{{$tot_garnitur}}</td>
                            </tr>
                            <tr>
                              <td colspan="3">{{$bop2->nama_bop}} ({{$hpp_detail->besaran_bop2}}%)</td>
                              <td  class=" text-center"></td>
                              <td  class=" text-center">{{$tot_sales}}</td>
                            </tr>
                      
                            <tr>
                              <th colspan="3">Total Overhead</th>
                              <td  class=" text-center"></td>
                              <th  class=" text-center">{{$hpp_detail->total_bop}}</th>
                            </tr>
                            <tr>
                              <th colspan="3">Harga Pokok Produksi</th>
                              <td  class=" text-center"></td>
                              <td  class=" text-center"><b>{{$hpp_detail->total_hpp}}<b></td>
                            </tr>
                            <tr>
                              <td colspan="3"> <b>Harga Jual</b> (HPP + (70% HPP) * 1,21)  </td>
                              <td  class=" text-center"></td>
                              <td  class=" text-center"><b>{{$hpp_detail->h_jual}}<b></td>
                            </tr>
                            
                          </tbody>
                    </table>
                    <table class="table table-bordered ">
                    <thead>
                      <tr>
                        <td rowspan="2"><b>Preparation Service : </b><br>
                          <p>{{$makanan_detail->penyajian}}</p>
                        </td>
                
                      </thead>
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
