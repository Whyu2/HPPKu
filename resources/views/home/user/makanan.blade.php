
        @extends('layout/main')
        @section('container')
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Makanan</h1>
            <div class="row">
              <div class="col-xl-12">
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <strong>   List Makanan</strong>
              </div>
           
             
              
           
              <div class="card-body">
                @if(session()->has('hapus'))
                <div class="alert alert-danger allert-dismissible fade show mt-1 p-2" role="alert">
                  {{session('hapus')}}
                </div>
                @endif
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
                <table id="datatablesSimple">
                  <thead>
                    <tr>
                      <th>No</th>
                      
                      <th>Nama Makanan</th>
                      <th>Kd Makanan</th>
                      <th>Kategori</th>
                      <th>Penyajian</th>
                      <th>Tanggal Dibuat</th>
                      <th>Olah Data</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      
                      <th>Nama Makanan</th>
                      <th>Kd Makanan</th>
                      <th>Kategori</th>
                      <th>Penyajian</th>
                      <th>Tanggal Dibuat</th>
                      <th>Olah Data</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $number = 1; ?>
                    @foreach ($makanan as $key => $mkn)
                    <tr>
                      <td>{{ $number }}</td>
                      <td>{{$mkn->nama_makanan}}</td>
                      <td>{{$mkn->kd_makanan}}</td>
                      <td>{{$mkn->kategori->nama_kategori}}</td>
                      <td>{{$mkn->penyajian}}</td>
                      <td>{{formatDate($mkn->created_at)}}</td>
                  
                      <?php $number++; ?>
                      <th>
                        <div class="col-1">
                       
                         </div>
                          <a href="{{route('editm',$mkn->id)}}" class="btn btn-success btnku" ><i class="fas fa-edit"></i></a>
                        {{-- <a href="{{route('deletem',$mkn->id)}}" class="btn btn-danger mt-2"><i class="fas fa-trash-alt"></i></a> --}}
                        <button type="button" value="{{$mkn->id}}" class="btn btn-danger deletbtm"><i class="fas fa-trash-alt"></i></button>
                      </th>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @if (auth()->user()->level == "user")
                <div class="col-3  mt-2">
                  <a href="/makanan/tambah" type="submit" class="btn btn-primary">Tambah</a>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      
      </main>
        @endsection