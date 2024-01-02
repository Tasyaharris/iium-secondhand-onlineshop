 
<section class="header border-bottom mt-0" id="header">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-0">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">
        <img src="/images/logo.png" alt="logo" width="40" height="40">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ">
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Fashion") ? 'active' : ' ' }}" aria-current="page" href="/fashion">FASHION</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('books') ? 'active' : ' ' }}"  aria-current="page" href="/books">BOOKS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('electronics') ? 'active' : ' ' }}"  aria-current="page" href="/electronics">ELECTRONICS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Cosmetics") ? 'active' : ' ' }}"  aria-current="page" href="/cosmetics">COSMETICS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Others") ? 'active' : ' ' }}"  aria-current="page" href="/others">OTHERS</a>
          </li>
        </ul>

        <ul class="navbar-nav ms-auto" >
{{--           
          <li class="nav-item mt-2" style="margin-right:6px;">
            {{-- <a href="/chatpage"> --}}
            {{-- <a href="/chatpage">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-chat-fill" viewBox="0 0 16 16">
                <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9.06 9.06 0 0 0 8 15"/>
              </svg>
            </a>
          </li>  --}}

          <li class="nav-item mt-2" style="margin-right:6px;">
            <a href="/cart">
              <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="white" class="bi bi-cart-fill" viewBox="0 0 16 16" style="margin-right:3px;">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
              </svg>
            </a>
          </li>

          <li class="nav-item mt-2" style="margin-right:6px;">
            <a href="/likes">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-heart" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
              </svg>
            </a>
          </li>

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
</section>

<nav class="navbar bg-body-tertiary border-bottom mt-0">
  <div class="container-fluid">
    <a href="/homepage" class=" p-3  text-decoration-none d-inline" style="font-weight: bold; color:black;">IIUM SECOND-HAND ONLINE SHOP</a>
    
    <form action="/product/search" class="d-flex" style="margin-right:200px; width:500px" method="GET">
      <input class="form-control" type="search" name="search" placeholder="Search for Item" aria-label="Search">
    </form>

    <form action="/sell" class="d-flex">
      {{-- <button class="btn btn-outline-success ms-auto p-2" type="submit" style="background-color: #A8B8D0; color: black; border: none; text-align: center;">SELL</button> --}}
      <button type="submit" class="btn  btn-outline-success ms-auto p-2 btn-lg" type="submit" style="background-color: #A8B8D0; color: black; border: 1px solid black; text-align: center;">SELL</button>
      @if (Route::has('sell'))
      <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
          @auth
              <a href="/sell/index/create" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Sell</a>
          @else
              <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

              @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
              @endif
          @endauth
      </div>
    @endif
    </form>
  </div>
</nav>


  