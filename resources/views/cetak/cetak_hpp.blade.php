
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
                                   
                                    </div>
                                    <div class="col-8 kembali">
                                      <table>
                                        <tbody>
              
                        
              
                                        </tbody></table>
                                    </div>
                                    <div class="col-md-8 mt-5 kembali">
                                      <h5>Hotel Sahid Solo</h5>
                                      <h3><b>Proposal Harga & Cost </b></h3>
                                  
                           
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-4 mb-3 mx-auto">
                              <img src="{{asset('img/logo.jpg')}}" class="rounded mx-auto d-block" alt="...">
                            </div>
            
              

                </div>
                <div class="row">
                  <div class="col mt-3  kembali">
                  
                      <div class="row">
                      <div class="col-1 ">
           
                      </div>
                      <div class="col-4 ">
                        {{$nama_kategori}} 
                       </div>
                      <div class="col-3 ">
                   
                      </div>
                      <div class="col-3 ">
                        {{formatDate($date)}}
                      </div>
                    </div>
          
                    <table class="table  table-sm table-bordered">
      
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Nama</th>
                          <th class="text-center">KD Makanan</th>
                    
                          <th class="text-center">Harga Produksi</th>
                          <th class="text-center">Harga Jual</th>
                        
                        </tr>
                      </thead>   
                    
                      <tbody>
                        <?php $number=1; ?>
                        @foreach ($list as $key => $lists)
                        <tr>
                        <td class="text-center">{{$number}}</td>           
                        <td >{{$lists['nama_makanan']}}</td>
                        <td class="text-center">{{$lists['kd_makanan']}}</td>
          
                        <td class="text-center">{{formatIDR($lists['total_hpp'])}}</td>
                        <td class="text-center">{{formatIDR($lists['h_jual'])}}</td>
                  
                        <?php $number++; ?>
                        </tr>
                        @endforeach
                      </tbody>
                            
                         
                    </table>
              
                
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
