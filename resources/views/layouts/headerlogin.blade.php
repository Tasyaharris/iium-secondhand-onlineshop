<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/main.css">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body  class="d-flex flex-column min-vh-100">

    
  
    @include('partials.navbar')
 
    

      <div class="container mt-2 mb-5" style="height=auto;">
       
        @yield('container')

      </div>

    
    @include('partials.footer')
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>