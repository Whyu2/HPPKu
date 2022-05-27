
        @extends('layout/main')
        @section('container')
        <main>
          <div class="container-fluid px-4 mt-2">
 
            <div class="row">
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-header ">
                 <h3><i class="fas fa-hotel"></i>  Deksripsi Hotel</h3>
              </div>
            </div>
              </div>
              <div class="col-xl-12">
                <div class="card mb-4">
                  <h3 class="text-center">Hotel Sahid Jaya Solo
                  </h3>
                    <img src="{{asset('img/Hotel.jpeg')}}" class="img-fluid mx-auto rounded-2" alt="Responsive image"> 
                  <div class="col-12 p-2"><p class="lead">Sahid Jaya Solo adalah hotel berbintang empat yang merupakan properti kelas satu di Solo. Hotel bergaya simpel dengan fasilitas lengkap. Terdapat ruang pertemuan dan ruang konferensi untuk berbisnis. Setiap kamarnya diberi sentuhan khas tradisional ala Solo.</p></div> 
                </div>
              
                </div>
          </div>

          <div class="col-xl-12">
            <div class="card mb-2">
              <div class="card-header">
             <h3><i class="fas fa-map-marker-alt"></i> Lokasi Hotel</h3>
          </div>
        </div>
          </div>
          <div class="col-xl-12">
            <div class="embed-responsive embed-responsive-21by9 text-center">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.088504182689!2d110.8207616143742!3d-7.565329476813885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a16861963ecf1%3A0xef9b006b3b992b99!2sHotel%20Sahid%20Jaya%20Solo!5e0!3m2!1sid!2sid!4v1647862568882!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>


            </div>



            </div>
          </div>

          
        </main>
        @endsection