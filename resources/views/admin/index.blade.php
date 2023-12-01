<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-0">
        <div class="container-fluid">
          <a class="navbar-brand" href="/homepage">
            <img src="/images/logo.png" alt="logo" width="40" height="40">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
          
    
            <ul class="navbar-nav ms-auto" >
             @auth
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ auth()->user()->username }}
                 </a>
                  <ul class="dropdown-menu">
                   <li><a class="dropdown-item" href="/profile">Profile</a></li>
                   <li><hr class="dropdown-divider"></li>
                   <li><a class="dropdown-item" href="/settings">Settings</a></li>
                   <li><hr class="dropdown-divider"></li>
                   <li>
                      <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">
                          Logout
                        </button>
                      </form>
                    </li>
                  </ul>
               </li>
              @else
                <li class="nav-item mt-1">
                        <a class="navbar-brand {{ ($title === "Login") ? 'active' : ' ' }}" href="/login" style="margin-left:2px;">LOGIN</a>
                </li>
            
              
              @endauth
              </ul>
                
            
            
          </div>
       
        </div>  
      </nav>

     

      <nav class="navbar bg-body-tertiary border-bottom mt-0">
        <div class="container-fluid">
          <a href="/homepage" class=" p-3 text-secondary text-decoration-none d-inline" style="font-weight: bold ">IIUM SECOND-HAND ONLINE SHOP</a>
          
          <form action="/product/search" class="d-flex" style="margin-right:200px; width:500px" method="GET">
            <input class="form-control" type="search" name="search" placeholder="Search for Item" aria-label="Search">
          </form>
      
          <form action="/sell" class="d-flex">
            <button class="btn btn-outline-success ms-auto p-2" type="submit" style="background-color: #A8B8D0; color: black; border: none; text-align: center;">SELL</button>
            @if (Route::has('sell'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="/sell/index/create" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Sell</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
      
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
          @endif
          </form>
        </div>
      </nav>
      
     
      
      @include('partials.footer')
    
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    
  </body>
</html>