
        @extends('layout/main')
        @section('container')
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Bahan Baku</h1>
            <div class="row">
              <div class="col-xl-12">
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <strong>  List Bahan Baku</strong>
              </div>
           
            
              
           
              <div class="card-body">
                @if(session()->has('hapus'))
                <div class="alert alert-danger allert-dismissible fade show mt-1" role="alert">
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
                      <th>KD Bahan</th>
                      <th>Nama bahan baku</th>
                      <th>Satuan</th>
             
                      <th>Harga</th>
                      <th>Tanggal Dibuat</th>
                      <th>Olah Data</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>KD Bahan</th>
                      <th>Nama bahan baku</th>
                      <th>Satuan</th>
            
                      <th>Harga</th>
                      <th>Tanggal Dibuat</th>
                      <th>Olah Data</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $number = 1; ?>
                    @foreach ($BahanBaku as $key => $bhn)
                    <tr>
                      <td>{{ $number }}</td>
                      <td>{{$bhn->kd_bahan}}</td>
                      <td>{{$bhn->nama_bahan}}</td>
                      <td>{{$bhn->satuan}}</td>
              
                      <td>{{ formatIDR($bhn->harga) }}</td>
                      <td>{{formatDate($bhn->created_at)}}</td>
                  
                      <?php $number++; ?>
                      <th>
                   
                          <a href="{{route('editb',$bhn->id)}}"class="btn btn-success btnku" ><i class="fas fa-edit"></i></a>
                        {{-- <a href="{{route('deleteb',$bhn->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> --}}
                        <button type="button" value="{{$bhn->id}}" class="btn btn-danger deletbtnbahan "><i class="fas fa-trash-alt"></i></button>
                      </th>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @if (auth()->user()->level == "user")
                <div class="col-3  mt-2">
                  <a href="/bahan_baku/tambah" type="submit" class="btn btn-primary">Tambah</a>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
        </main>
      </main>
        @endsection