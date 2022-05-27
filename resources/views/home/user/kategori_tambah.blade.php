
        @extends('layout/main')
        @section('container')
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Kategori</h1>
            <div class="row">
              <div class="col-xl-12">
                @if (auth()->user()->level == "user")
                <div class="card mb-4">
                  <div class="card-header">
                    <i class="fas fa-list-alt"></i>
                    <strong> Tambah kategori </strong>
                  </div>
                  <form action="/kategori/store" method="post">
                    @csrf
                    <div class="form-group p-3">
                      <label for="exampleInputEmail1">Nama Kategori</label>

                      <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori"
                      placeholder="Nama Kategori" value="{{ old('nama_kategori') }}" name="nama_kategori" required>
                       @error('nama_kategori')
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
            @endif
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <strong>  List Data Kategori</strong>
          
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
                      <th>Nama Kategori</th>
                      <th>Tanggal Pembuatan</th>
                      <th>Olah Data</th>
                     
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama Kategori</th>
                      <th>Tanggal Pembuatan</th>
                      <th>Olah Data</th>
                    </tr>
                  </tfoot>
                  <tbody>
                 

                    <?php
         
                      $number = 1; ?>
                    @foreach ($kategori as $key => $kat)
                    <tr>
                      <td>{{ $number }}</td>
                      <td>{{$kat->nama_kategori}}</td>
                      <td>
                        {{ formatDate($kat->created_at) }}
                    </td>
                  
                      <?php $number++; ?>
                      <th>
                          <a href="{{route('edit',$kat->id)}}"class="btn btn-success btnku " ><i class="fas fa-edit"></i></a>
                          
                        {{-- <a href="{{route('delete',$kat->id)}}" class="btn btn-danger mt-2"><i class="fas fa-trash-alt"></i></a> --}}
                        <button type="button" value="{{$kat->id}}" class="btn btn-danger  deletbtn"><i class="fas fa-trash-alt"></i></button>
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