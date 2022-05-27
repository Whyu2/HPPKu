
        @extends('layout/main')
        @section('container')
  
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Home</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
              <div class="col-xl-3 col-md-6">
                <div class="card bg-success border-light   text-white mb-4">
                  <img src="{{ asset('img/kategori.jpg') }}" class="card-img" alt="...">
                  <div class="card-body">
                    <i class="fas fa-list-alt fa-2x"></i>
                    Kategori <b>({{$jumlahk}})</b></div>
                  <div
                    class="card-footer d-flex align-items-center justify-content-between"
                  >
                    <a class="small text-white stretched-link" href="\kategori"
                      >Tampilkan Detail</a
                    >
                    <div class="small text-white">
                      <i class="fas fa-angle-right"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card  bg-primary border-light   text-white mb-4">
                  <img src="{{ asset('img/bahan.jpg') }}" class="card-img" alt="...">
                  <div class="card-body">
                <i class="fas fa-mortar-pestle fa-2x"></i>
                Bahan Baku <b>({{$jumlahb}})</b></div>
                  <div
                    class="card-footer d-flex align-items-center justify-content-between"
                  >
                    <a class="small text-white stretched-link" href="\bahan_baku"
                      >Tampilkan Detail</a
                    >
                    <div class="small text-white">
                      <i class="fas fa-angle-right"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card  bg-danger  border-light  text-white mb-4">
                  <img src="{{ asset('img/makanan.jpg') }}" class="card-img" alt="...">
                  <div class="card-body">
                    <i class="fas fa-utensils fa-2x"></i>
                    Makanan <b>({{$jumlahm}})</b></div>
                  <div
                    class="card-footer d-flex align-items-center justify-content-between"
                  >
                    <a class="small text-white stretched-link" href="\makanan"
                      >Tampilkan Detail</a
                    >
                    <div class="small text-white">
                      <i class="fas fa-angle-right"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card  bg-dark  border-light  text-white mb-4">
                  <img src="{{ asset('img/costpermakanan.jpg') }}" class="card-img" alt="...">
                  <div class="card-body">
                    <i class="fas fa-calculator fa-2x"></i>
                    HPP Permakanan <b>({{$jumlahh}})</b></div>
                  <div
                    class="card-footer d-flex align-items-center justify-content-between"
                  >
                    <a class="small text-white stretched-link" href="\hpp"
                      >Tampilkan Detail</a
                    >
                    <div class="small text-white">
                      <i class="fas fa-angle-right"></i>
                    </div>
                  </div>
                </div>
              </div>

          
              @if (auth()->user()->level == "admin")
              <div class="col-xl-3 col-md-6">
                <div class="card  bg-secondary  border-light  text-white mb-4">
                  <img src="{{ asset('img/event.jpg') }}" class="card-img" alt="...">
                  <div class="card-body">
                    <i class="fas fa-calendar-check fa-2x"></i>
                    Event Order<b>({{$jumlahh}})</b></div>
                  <div
                    class="card-footer d-flex align-items-center justify-content-between"
                  >
                    <a class="small text-white stretched-link" href="\event"
                      >Tampilkan Detail</a
                    >
                    <div class="small text-white">
                      <i class="fas fa-angle-right"></i>
                    </div>
                  </div>
                </div>
              </div>
            @endif

            </div>
            <div class="row" style="background-color:       rgb(255, 255, 255)">
              <div class="col-xl-4 mt-3 mb-3 ">
                <div class="card ">
                  <div class="card-header text-white bg-success">
                    <i class="fas fa-list-alt"></i>
                   kategori
                  </div>
                  <div class="card-body">
                    <ul class="list-group">
                    @if($kategori->isEmpty())
                    <li class="list-group-item"><span>Data kosong</span></li>
                    @else
                    <?php $number = 1; ?>
                    @foreach ($kategori as $key => $kat)
                    <li class="list-group-item"><span>{{ $number }}. </span> {{$kat->nama_kategori}}</li>
                    <?php $number++; ?>
                    @endforeach
                    @endif
                      </ul>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 mt-3 mb-3 ">
                <div class="card ">
                  <div class="card-header text-white bg-primary">
                    <i class="fas fa-mortar-pestle"></i>
                   Bahan Baku
                  </div>
                  <div class="card-body">
                    @if($bahan->isEmpty())
                    <ul class="list-group">
                   
                      <div class="list-group">
                        <a href="" class="d-flex justify-content-between list-group-item list-group-item-action">
                          <span class="">Data Kosong </span>       
                        </a>
                      </div>
                      </ul>
                    @else
                    <ul class="list-group">
                      <?php $number = 1; ?>
                      @foreach ($bahan as $key => $bah)
                      <div class="list-group">
                        <div  class="d-flex justify-content-between list-group-item list-group-item-action">
                         <span class="">{{ $number }}. {{$bah->nama_bahan}} </span> 
                          <span class=""> </span> 
                        </div>
                      </div>
                      <?php $number++; ?>
                      @endforeach
                      </ul>
                      @endif
                  </div>
                </div>
              </div>
              
              <div class="col-xl-4 mt-3 mb-3 ">
                <div class="card ">
                  <div class="card-header text-white bg-danger">
                    <i class="fas fa-utensils"></i>
                 Makanan
                  </div>
                  <div class="card-body">
                    <ul class="list-group">
                      @if($makanan->isEmpty())
                      <li class="list-group-item">Data kosong</li>
                      @else
                      <?php $number = 1; ?>
                      @foreach ($makanan as $key => $ma)
                      <li class="list-group-item"><span>{{ $number }}. </span> {{$ma->nama_makanan}}</li>
                      <?php $number++; ?>
                      @endforeach
                      @endif
                      </ul>
                  </div>
                </div>
              </div>
              <div class="col-xl-5 mt-3 mb-3 ">
                <div class="card ">
                  <div class="card-header text-white bg-dark">
                    <i class="fas fa-calculator"></i>
                 HPP Permakanan
                  </div>
                  <div class="card-body">
                    <ul class="list-group">
                      @if($hpp->isEmpty())
                      <li class="list-group-item">Data kosong</li>
                      @else
                      <?php $number = 1; ?>
                      @foreach ($hpp as $key => $ha)
                      <div class="list-group">
                        <div  class="d-flex justify-content-between list-group-item list-group-item-action">
                        <span class="">{{ $number }}. {{$ha->makanan->nama_makanan}} </span>
                          <span class="">{{formatIDR($ha->total_hpp)}}</span> 
                        </div>
                      </div>
                      <?php $number++; ?>
                      @endforeach
                      </ul>
                      @endif


                  </div>
                </div>
              </div>
              <div class="col-xl-4 mt-3 mb-3 ">
                <div class="card text-dark  ">
                  <div class="card-header text-white bg-secondary">
                    <i class="fas fa-calendar-check"></i>
                 Event Order
                  </div>
                  <div class="card-body">
                    <ul class="list-group">
                      {{-- @if($event->Null())
                      <li class="list-group-item">Data kosong</li>
                      @else --}}
                     
                      <?php $number = 1; ?>
                      @foreach ($event as $key => $e)
                      <div class="list-group">
                        <div  class="d-flex justify-content-between list-group-item list-group-item-action">
                         <span class="">{{ $number }}. {{$e->nama_event}}</span>
                         @php
                          $days = $events->lamaevent($e->tgl_mulai,$e->tgl_selesai);
                         @endphp
                          <span class="">{{$days}} hari</span> 
             
                        </div>
                      </div>
                      <?php $number++; ?>
                      @endforeach
                      </ul>
                      {{-- @endif --}}


                  </div>
                </div>
              </div>
            </div>
          
          </div>
        </main>
   
        @endsection