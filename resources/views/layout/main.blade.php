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
    <title>{{$title}}</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico')}}" type="image/x-icon">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    <link
      href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css"
      rel="stylesheet"
    />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script
      crossorigin="anonymous" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
    ></script>

    {{--date --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


  </head>
  <body class="sb-nav-fixed">
    <nav
      class="sb-topnav navbar navbar-expand"
      {{-- style="background-color: rgb(197, 164, 79)" --}}
            style="background-color:       rgb(255, 195, 0)"

    >
   
      <a class="navbar-brand ps-3" href="\user">
        <img src="{{ asset('img\logo2.png') }}" class="img"width="40%" alt="..."><span class="logo1 text-dark">SAHID JAYA</span>
      
      </a>
      
     <button
        class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 "
        id="sidebarToggle"
        href="#!"

      >
        <i class="fas fa-bars"></i>
      </button> 
      <!-- Navbar Search-->
      <form
        class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"
      >
        
     
        </div>
      </form>
      <!-- Navbar-->
      <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle hoverku"
            id="navbarDropdown"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            ><i class="fas fa-user fa-fw"></i
          ></a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdown"
          >
            <li><a class="dropdown-item" href="{{route('profile',auth()->user()->id)}}"><i class="fas fa-user"></i> Profile</a></li>

            <li><form action="/logout" method="post">
            @csrf

            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>

          </li>
          </ul>
        </li>
      </ul>
    </nav>
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
            <div class="nav">
              <div class="sb-sidenav-menu-heading"></div>
              @if (auth()->user()->level == "user")
              <a class="nav-link" href="\user">
              @endif
              @if (auth()->user()->level == "admin")
              <a class="nav-link" href="\admin">
              @endif
                <div class="sb-nav-link-icon">
                  <i class="fas fa-home"></i>
                </div>
                Home
              </a>
              <a class="nav-link" href="\about">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-hotel"></i>
                </div>
                About
              </a>
              <a class="nav-link" href="\kategori">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-list-alt"></i>
                </div>
              Kategori Menu
              </a>
              @if (auth()->user()->level == "user")
          
              <div class="sb-sidenav-menu-heading">Olah Data {{auth()->user()->level}} </div>
              <a
              class="nav-link collapsed"
              href="#"
              data-bs-toggle="collapse"
              data-bs-target="#collapseLayouts"
              aria-expanded="false"
              aria-controls="collapseLayouts"
            >
              <div class="sb-nav-link-icon">
                <i class="fas fa-mortar-pestle"></i>
              </div>
              Olah Bahan Baku
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div
            class="collapse"
            id="collapseLayouts"
            aria-labelledby="headingOne"
            data-bs-parent="#sidenavAccordion"
          >
            <nav class="sb-sidenav-menu-nested nav">
              
              <a class="nav-link" href="\bahan_baku"
                >
                <div class="sb-nav-link-icon">
                  <i class="fas fa-table me-1"></i>
                </div>
                list Bahan Baku</a
              >
              <a class="nav-link" href="\bahan_baku\tambah"
                >
                <div class="sb-nav-link-icon">
                  <i class="fas fa-plus"></i>
                </div>
                Tambah Bahan Baku</a
              >
            </nav>
          </div>
          
              
              <div class="sb-sidenav-menu-heading">Perhitungan HPP permakanan </div>
              <a
              class="nav-link collapsed"
              href="#"
              data-bs-toggle="collapse"
              data-bs-target="#collapseHpp"
              aria-expanded="false"
              aria-controls="collapseHpp"
            >
              <div class="sb-nav-link-icon">
                <i class="fas fa-utensils"></i>
              </div>
              Olah Makanan
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div
            class="collapse"
            id="collapseHpp"
            aria-labelledby="headingOne"
            data-bs-parent="#sidenavAccordion"
          >
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link" href="\makanan"
                >
                <div class="sb-nav-link-icon">
                  <i class="fas fa-table me-1"></i>
                </div>
                list Makanan</a
              >
              <a class="nav-link" href="\makanan\tambah"
                >
                <div class="sb-nav-link-icon">
                  <i class="fas fa-plus"></i>
                </div>
                Tambah Makanan</a
              >
              
            </nav>
            
          </div>
          <a class="nav-link" href="\hpp">
            <div class="sb-nav-link-icon">
              <i class="fas fa-calculator"></i>
            </div>
            HPP Makanan
          </a>
              
        
      
@endif
@if (auth()->user()->level == "admin")






<a class="nav-link" href="\bahan_baku"
>
<div class="sb-nav-link-icon">
  <i class="fas fa-mortar-pestle"></i>
</div>
Bahan Baku</a
>
<a class="nav-link" href="\makanan"
>
<div class="sb-nav-link-icon">
  <i class="fas fa-utensils"></i>
</div>
Makanan</a
>
<a class="nav-link" href="\hpp"
>
<div class="sb-nav-link-icon">
  <i class="fas fa-calculator"></i>
</div>
HPP Makanan</a
>
<div class="sb-sidenav-menu-heading">Olah Data {{auth()->user()->level}} </div>


<a
class="nav-link collapsed"
href="#"
data-bs-toggle="collapse"
data-bs-target="#collapseLayouts"
aria-expanded="false"
aria-controls="collapseLayouts"
>
<div class="sb-nav-link-icon">
  <i class="fas fa-clipboard-list"></i>
</div>
Olah Master
<div class="sb-sidenav-collapse-arrow">
  <i class="fas fa-angle-down"></i>
</div>
</a>
<div
class="collapse"
id="collapseLayouts"
aria-labelledby="headingOne"
data-bs-parent="#sidenavAccordion"
>
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link" href="\bop"
  >
  <div class="sb-nav-link-icon">
    <i class="fas fa-warehouse"></i>
  </div>
  Ubah BOP</a
>
<a class="nav-link" href="\btkl"
  >
  <div class="sb-nav-link-icon">
    <i class="fas fa-people-carry"></i>
  </div>
  Ubah BTKL</a
>
<a class="nav-link" href="\cost"
  >
  <div class="sb-nav-link-icon">
    <i class="far fa-money-bill-alt"></i>
  </div>
  Ubah Cost</a
>
</nav>
</div>


{{-- //////////////////////// --}}
<a
class="nav-link collapsed"
href=""
data-bs-toggle="collapse"
data-bs-target="#collapseLayoutss"
aria-expanded="false"
aria-controls="collapseLayoutss"
>
<div class="sb-nav-link-icon">
  <i class="fas fa-calendar-check"></i>

</div>
Olah Event Order
<div class="sb-sidenav-collapse-arrow">
  <i class="fas fa-angle-down"></i>
</div>
</a>
<div
class="collapse"
id="collapseLayoutss"
aria-labelledby="headingOne"
data-bs-parent="#sidenavAccordion"
>
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link" href="\waktu"
  >
  <div class="sb-nav-link-icon">
    <i class="fas fa-clock"></i>
  </div>
  Waktu Makan</a
>
<a class="nav-link" href="\event"
  >
  <div class="sb-nav-link-icon">
    <i class="fas fa-plus"></i>
  </div>
 Tambah Event Order</a
>
</nav>
</div>

{{-- ///////////////////////////// --}}

<div class="sb-sidenav-menu-heading">Cetak Laporan</div>
<a
              class="nav-link collapsed"
              href="#"
              data-bs-toggle="collapse"
              data-bs-target="#collapseLaporan"
              aria-expanded="false"
              aria-controls="collapseLaporan"
            >
              <div class="sb-nav-link-icon">
                <i class="fas fa-file-export"></i>
              </div>
            Cetak Laporan
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div
            class="collapse"
            id="collapseLaporan"
            aria-labelledby="headingOne"
            data-bs-parent="#sidenavAccordion"
          >
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link" href="\cetak_hpp"
                >
                <div class="sb-nav-link-icon">
                  <i class="fas fa-file-contract"></i>
           
                </div>
       HPP Makanan</a
              >
              <a class="nav-link" href="\cetak_event"
                >
                <div class="sb-nav-link-icon">
                  <i class="fas fa-file-contract"></i>
            
                </div>
            Event Order</a
              >
            </nav>
          </div>
@endif
        </nav>
      </div>
      <div id="layoutSidenav_content">
   
          @yield('container')
        
      
        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid px-4">
            <div
              class="d-flex align-items-center justify-content-between small"
            >
            <div class="text-muted">Copyright © 2022 Sistem HPP Makanan</div>
            </div>
          </div>
        </footer>
      </div>
    </div>

 
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
  
  
    <script
      src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"
      crossorigin="anonymous"
    ></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
  </body>
</html>


{{-- modal --}}
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt fa-1x"></i> Hapus Kategori</h5>
     
       
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ url('deletekategori') }}" method="POST">
          @csrf
          @method('DELETE')
          <label>Yakin akan dihapus ?</label>
          <input type="hidden" id="deleteing_id" name="delete_kategori">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="DeleteModalbahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt fa-1x"></i> Hapus bahan baku</h5>
     
       
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ url('deletebahan') }}" method="POST">
          @csrf
          @method('DELETE')
          <label>Yakin akan dihapus ?</label>
          <input type="hidden" id="deleteing_id_bahan" name="delete_bahan">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="DeleteModalmakanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt fa-1x"></i> Hapus Makanan</h5>
     
       
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ url('deletemakanan') }}" method="POST">
          @csrf
          @method('DELETE')
          <label>Yakin akan dihapus ?</label>
          <input type="hidden" id="deleteing_id_makanan" name="delete_makanan">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="DeleteModalhpp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt fa-1x"></i> Hapus HPP</h5>
     
       
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ url('deletehpp') }}" method="POST">
          @csrf
          @method('DELETE')
          <label>Yakin akan dihapus ?</label>
          <input type="hidden" id="deleteing_id_hpp" name="delete_hpp">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="DeleteModalwaktu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt fa-1x"></i> Hapus Waktu</h5>
     
       
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ url('deletewaktu') }}" method="POST">
          @csrf
          @method('DELETE')
          <label>Yakin akan dihapus ?</label>
          <input type="hidden" id="deleteing_id_waktu" name="delete_waktu">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="DeleteModalevent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt fa-1x"></i> Hapus Event</h5>
     
       
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ url('deleteevent') }}" method="POST">
          @csrf
          @method('DELETE')
          <label>Yakin akan dihapus ?</label>
          <input type="text" id="deleteing_id_event" name="delete_event">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </form>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  $(document).ready(function() {

    
    $(document).on('click', '.deletbtn',function(){
      var id_kat = $(this).val();
      // alert(id_kat);
      $('#DeleteModal').modal('show');
      $('#deleteing_id').val(id_kat);
    });

    $(document).on('click', '.deletbtnbahan',function(){
      var id_kat = $(this).val();
      // alert(id_kat);
      $('#DeleteModalbahan').modal('show');
      $('#deleteing_id_bahan').val(id_kat);
    });

    $(document).on('click', '.deletbtm',function(){
      var id_kat = $(this).val();
      // alert(id_kat);
      $('#DeleteModalmakanan').modal('show');
      $('#deleteing_id_makanan').val(id_kat);
    });

    $(document).on('click', '.delethpp',function(){
      var id_kat = $(this).val();
      // alert(id_kat);
      $('#DeleteModalhpp').modal('show');
      $('#deleteing_id_hpp').val(id_kat);
    });

    $(document).on('click', '.deletwaktu',function(){
      var id_wa = $(this).val();
      // alert(id_kat);
      $('#DeleteModalwaktu').modal('show');
      $('#deleteing_id_waktu').val(id_wa);
    });

    $(document).on('click', '.deletevent',function(){
      var id_ev = $(this).val();
      // alert(id_kat);
      $('#DeleteModalevent').modal('show');
      $('#deleteing_id_event').val(id_ev);
    });

    $(".add-more").click(function(){ 
     
        var html = $(".copy").html();
   
        $(".after-add-more").after(html);
    });

    // saat tombol remove dklik control group akan dihapus 
    $("body").on("click",".remove",function(){ 
        $(this).parents(".control-group").remove();
    });
  });
</script>


<script>
  $(function(){
    $.ajaxSetup({
      headers : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    $(function(){
      $('#makanan').on('change',function(){
        let id_makanan = $('#makanan').val()

        $.ajax({
        
          success: function(msg){
            $("#outmakanan").val(id_makanan);
          },
          error: function(data){
          console.log('error:', data);
          },
        })
      })
    })

    $(function(){
      $('#waktu').on('change',function(){
        let id_waktu = $('#waktu').val();
      
        $.ajax({
          success: function(msg){
            $("#outwaktu").val(id_waktu);
          },
          error: function(data){
          console.log('error:', data);
          },
        })
      })
    })

    $(function(){
      $('#nama').on('change',function(){
        let nama = $('#nama').val();
      
        $.ajax({
          success: function(msg){
            $("#outnama").val(nama);
          },
          error: function(data){
          console.log('error:', data);
          },
        })
      })
    })

    $(function(){
      $('#tglmulai').on('change',function(){
        let tglmulai = $('#tglmulai').val();
      
        $.ajax({
          success: function(msg){
            $("#outtglmulai").val(tglmulai);
          },
          error: function(data){
          console.log('error:', data);
          },
        })
      })
    })
    $(function(){
      $('#tglselesai').on('change',function(){
        let tglselesai = $('#tglselesai').val();
      
        $.ajax({
          success: function(msg){
            $("#outtglselesai").val(tglselesai);
          },
          error: function(data){
          console.log('error:', data);
          },
        })
      })
    })
  });

  


</script>
  
<script type="text/javascript">
  $('.date').datepicker({  
     format: 'dd-mm-yyyy'
   });  
</script> 





