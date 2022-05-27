
        @extends('layout/main')
        @section('container')
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Waktu Makan</h1>
            <div class="row">
              <div class="col-xl-12">
                
                <div class="card mb-4">
                  <div class="card-header">
                    <i class="fas fa-list-alt"></i>
                    <strong> Tambah Waktu </strong>
                  </div>
                  <form action="/waktu/store" method="post">
                    @csrf
                    <div class="form-group p-3">
                      <label for="exampleInputEmail1">Nama Waktu</label>

                      <input type="text" class="form-control @error('nama_waktu') is-invalid @enderror" id="nama_waktu"
                      placeholder="Nama Waktu"  name="nama_waktu"  value="{{ old('nama_waktu') }}" >
                       @error('nama_waktu')
                      <div class="invalid-feedback"> {{ $message }}</div>
                      @enderror
                      <button type="submit" class="btn btn-primary mt-3">Tambah</button>
                      @if(session()->has('sukses'))
                      <div class="alert alert-success allert-dismissible fade show mt-1" role="alert">
                        {{session('sukses')}}
                      </div>
                      @endif
                  </form>
                </div>
              </div>
     
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <strong>  List Data Waktu</strong>
          
              </div>
              <div class="card-body">
          
       
              @if(session()->has('hapus'))
              <div class="alert alert-danger allert-dismissible fade show mt-1" role="alert">
                {{session('hapus')}}
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
                      <th>Nama Waktu</th>
                      <th>Tanggal Pembuatan</th>
                      <th>Olah Data</th>
                     
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama Waktu</th>
                      <th>Tanggal Pembuatan</th>
                      <th>Olah Data</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $number = 1; ?>
                    @foreach ($waktu as $key => $wa)
                    <tr>
                      <td>{{ $number }}</td>
                      <td>{{$wa->nama_waktu}}</td>
                      <td>
                        {{ formatDate($wa->created_at) }}
                    </td>
                  
                      <?php $number++; ?>
                      <th>
                          <a href="{{route('editwa',$wa->id)}}"class="btn btn-success btnku " ><i class="fas fa-edit"></i></a>
                          
                        {{-- <a href="{{route('delete',$kat->id)}}" class="btn btn-danger mt-2"><i class="fas fa-trash-alt"></i></a> --}}
                        <button type="button" value="{{$wa->id}}" class="btn btn-danger  deletwaktu"><i class="fas fa-trash-alt"></i></button>
                      </th>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          </div>
        </div>
        </main>
        @endsection