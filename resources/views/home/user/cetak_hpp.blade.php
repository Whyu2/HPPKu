
        @extends('layout/main')
        @section('container')
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Cetak Laporan HPP</h1>
            
            <div class="row">
     
          <div class="col-xl-12">
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-file-contract"></i>
                <strong>   List HPP</strong>
              </div>
        
             
            
           
              <div class="card-body">
              
                <table id="datatablesSimple">
                 <div class="row  ">
                  <div class="col-3">
                    <label for="exampleInputEmail1">Pilih Kategori Makanan</label>
                  </div>
                  <div class="row  mb-2">
                    <div class="col-3">
                    <form action="/cetak_hpp/pilih_kategori" method="POST">
                      @csrf
                    <select class="form-select" name="id_kategori" id="waktu"  aria-label="Default select example">
                      <option selected>Pilih Kategori</option>
                      @foreach ($kategori as $kat)
                      <option value="{{$kat->id}}">{{$kat->nama_kategori}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-7  ">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                    
                  </form>
                  
                
                    </div>
                   
                     
               
                      
                    
                    </div>
                 
                  </div>
                  <thead>
                    <tr>
                      <th>No</th>
                      
                      <th>KD makanan</th>
                      <th>Nama</th>
                      <th>kategori</th>
                      <th>Harga Produksi</th>
                      <th>Harga Jual</th>
                    
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>KD makanan</th>
                      <th>kategori</th>
                      <th>Nama</th>
                      <th>Harga Produksi</th>
                      <th>Harga Jual</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $number=1; ?>
                    @foreach ($list as $key => $lists)
                    <tr>
                    <td>{{$number}}</td>
                    <td>{{$lists['kd_makanan']}}</td>
                    <td>{{$lists['nama_makanan']}}</td>
                    <td>{{$lists['nama_kategori']}}</td>
                    <td>{{formatIDR($lists['total_hpp'])}}</td>
                    <td>{{formatIDR($lists['h_jual'])}}</td>
              
                    <?php $number++; ?>
                    </tr>
                    @endforeach
                  </tbody>
                  
                </table>
           
                
                  <div class="row  mb-2">
                   
                  <div class="col-10  ">
                  
                    
                  </form>
                  
                
                    </div>
                   
                     
                    <div class="col-2 text-right ">
                      <a href="{{route('print')}}" target"_blank" class="btn btn-success float-right"><i class="fas fa-print"></i> Cetak</a>
                    
              
                      </div>
                      
                      
                    </div>
                 
                
              </div>


          </div>

              </div>





        














        

        </main>
  
        @endsection