<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/> 

    <!-- Bootstrap CSS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <title>Login</title>
  </head>
  <body>

  <div class="container">
    <div class="col-sm-4 mx-auto box">
    
 <img src="{{ asset('img/logo.jpg') }}" class="rounded mx-auto d-block" alt="...">
 
 <div class="hr">
  
 </div>


 @if(session()->has('success'))
 <div class="alert alert-success allert-dismissible fade show text-center" role="alert">
   {{session('success')}}
 </div>
 @endif

 @if(session()->has('loginError'))
 <div class="alert alert-danger allert-dismissible fade show text-center" role="alert">
   {{session('loginError')}}
 </div>
 @endif

   <form action="/login" method="post">
     @csrf 

   <label class="mb-1" for=""><b>Username</b></label>

    <div class="formlogin">
      <span class="fa fa-user"></span>
      <input type="text" name="username" class="form-control" placeholder="Masukkan Username" autofocus required>
    </div>

 {{-- <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" id="username" autofocus required> --}}

<label class="mb-1 mt-2" for=""><b>Password</b></label>

    <div class="formlogin">
      <span class="fas fa-key"></span>
      <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
    </div>

 {{-- <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" id="password" required> --}}



<div class="d-grid gap-2 mt-2">
 <button type="submit" class="btn btn-primary ">Masuk</button>

  
</div>




  <div
    class="mt-2 justify-content-between small text-center"
  >
    <div class="text-muted">Copyright © 2022 Sistem HPP Makanan</div>
  
  </div>

   </form>
	</div>
</div>
 
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>