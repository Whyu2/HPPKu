
        @extends('layout/main')
        @section('container')
             {{-- pemanggilan function dari model --}}
             @php
             $tot_bahan = $resep->totalbahan($makanan_detail->id);
             $tot_garnitur = $hpp->totalgarnitur($makanan_detail->id);
             $tot_sales = $hpp->totalsales($makanan_detail->id);
             @endphp
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">HPP</h1>
            <div class="row" >
                <div class="col-md-8">
                  <div class="card  mb-4 ">
                    <div class="card-header bg-dark">
                        <div class="row">
                          <div class="col-md-9 text-white"> <strong>Detail Makanan</strong></div>
                          <div class="col-md-3 text-white"><i class="far fa-calendar-alt"></i> <label>{{formatDate($makanan_detail->created_at)}}</label></div>
                        </div>
                   
                         </div>
                  <div class="row">
                    <div class="kembali">
                      <i class="fas fa-arrow-left"></i><a href="/hpp"> Kembali</a>
                    </div>
                  </div>
                            <div class="row">  
                                <div class="col-md-6 mb-3">
                                    <div class="row">
                                   
                                        <div class="col-md-12 kembali">
                                          <label>Hotel Sahid Solo</label>
                                          <h4><b>Resep Standar</b></h4>
                                        </div>
                                        <div class="col-md-12 kembali">
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
                         
                     
                              <th rowspan="2"  class=" text-center">BAHAN</th>
                              <th rowspan="2"  class=" text-center">SATUAN</th>
                              <th rowspan="2"  class=" text-center">QTY</th>
                              <th colspan="3" class=" text-center">PERIODE BAHAN : {{formatDatebulan($perioderesep->bahan->created_at)}}</th>
                            </tr>
                            <tr>
                              <th  class=" text-center">Harga Satuan <br> (Dalam Rp)</th>
                              <th  class=" text-center">Total <br> (Dalam Rp)</th>
                            </tr>
                            
       
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
                                  <td colspan="3"> <b>Harga Jual = </b> (Nilai HPP * 70% HPP) * 1,21)  </td>
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
                    
                             </tbody>
                        </table>
                        </div>
                      </div>
                    </div>
             
                   
                     </div>
                  
                  </div>

                  <div class="col-xl-4">
                    <div class="card">
                      <div class="card-header bg-dark ">
                     
                            <div class="row">
                              <div class="col-md-7 text-white"><strong>Detail Manajemen</strong></div>    
                            </div>
                      
                           </div>
                            <div class="row">
                              <div class="card-body">
                                <div class="card-header">
                       
                                  <div class="col-md-7"> <strong>Biaya BTKL</strong></div>
                                  <div class="col-md-7"><label>Update ({{formatDate($btkl->updated_at)}})</label></div>
                                </div>
                
                                <ul class="list-group p-1">
                           
                                  <div class="list-group">
                              
                                    <div  class="d-flex justify-content-between list-group-item list-group-item-action">
                                      <span class="">BTKL Per PCS </span> 
                                      <span class=""><b>{{ formatIDR($btkl->besaran) }}</b></span> 
                                    </div>
                                  </div>
                          
                                  </ul>
                  
                              </div>
                            
                     
                           </div>
                            <div class="row">
                              <div class="card-body">
                                <div class="card-header">
                      
                                  <div class="col-md-7"> <strong>Biaya Overhead</strong></div>
                                  <div class="col-md-7"><label>Update ({{formatDate($bop->updated_at)}})</label></div>
                                </div>
                
                                <ul class="list-group p-1">
                           
                                  <div class="list-group">
                                    <div  class="d-flex justify-content-between list-group-item list-group-item-action">
                                      <span class="">{{$bop->nama_bop}} </span> 
                                      <span class=""><b>{{$bop->besaran}}%</b></span> 
                                    </div>
                          
                                   
                                  </div>
                          
                                  </ul>
                                  <div class="card-header">
                      
                                    <div class="col-md-7"><label>Update ({{formatDate($bop2->updated_at)}})</label></div>
                                  </div>
                  
                                  <ul class="list-group p-1">
                             
                                    <div class="list-group">
                                      <div  class="d-flex justify-content-between list-group-item list-group-item-action">
                                        <span class="">{{$bop2->nama_bop}} </span> 
                                        <span class=""><b>{{$bop2->besaran}}%</b></span> 
                                      </div>
                            
                                     
                                    </div>
                            
                                    </ul>
                              </div>
                            
                              {{-- <a href="{{route('deleteh',$detail->id)}}" class="btn btn-danger "><i class="fas fa-trash-alt fa-2x"></i></a> --}}
                     
                           </div>
                           
                           
                           
                       </div>
                    </div>
                    <div class="row">
                      @if (auth()->user()->level == "admin")
                      <div class="col-xl-3">
                        <div class="card mb-4">
                          <div class="card-header  bg-dark">
                              <div class="row">
                                  <div class="col text-center text-white"></i> <strong>Cetak Data</strong></div>
                              </div>
                               </div>
                                <div class="row mx-auto">
                                    <div class="col p-3">
                                      <a href="{{route('cetak_detail_hpp',$makanan_detail->id)}}" target"_blank" class="btn btn-primary "><i class="fas fa-print fa-2x"></i></a>
                                    </div>
                                    <div class="col p-3">
                                      <a href="{{route('cetak_detail_hpp_pdf',$makanan_detail->id)}}" target"_blank" class="btn btn-success "><i class="fas fa-file-pdf  fa-2x"></i></a>
                                    </div>
                                
                                  {{-- <a href="{{route('deleteh',$detail->id)}}" class="btn btn-danger "><i class="fas fa-trash-alt fa-2x"></i></a> --}}
                         
                               </div>
                               
                               
                               
                           </div>
                      </div>
                      @endif
                    <div class="col-xl-2">
                      <div class="card mb-4">
                        <div class="card-header bg-dark">
                            <div class="row">
                                <div class="col text-center text-white"></i> <strong>Hapus Data</strong></div>
                            </div>
                             </div>
                              <div class="row mx-auto">
                                  <div class="col p-3">
                                    <button type="button" value="{{$makanan_detail->id}}" class="btn btn-danger delethpp "><i class="fas fa-trash-alt fa-2x"></i></button>
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