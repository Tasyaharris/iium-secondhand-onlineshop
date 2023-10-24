
<section class="header border-bottom mt-0" id="header">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-0">
    <div class="container-fluid">
      <a class="navbar-brand" href="/homepage">
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
            <a class="nav-link {{ ($title === "Books") ? 'active' : ' ' }}"  href="/books">BOOKS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Electronics") ? 'active' : ' ' }}" href="/electronics">ELECTRONICS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Cosmetics") ? 'active' : ' ' }}" href="/cosmetics">COSMETICS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Others") ? 'active' : ' ' }}" href="/others">OTHERS</a>
          </li>
        </ul>

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
              <li class="nav-item">
                      <a class="navbar-brand {{ ($title === "Login") ? 'active' : ' ' }}" href="/login" >LOGIN</a>
              </li>
          
            
            @endauth
        </ul>
            
        
        
      </div>
    </div>  
  </nav>
</section>

<nav class="navbar bg-body-tertiary border-bottom mt-0">
  <div class="container-fluid">
    <a href="/homepage" class=" p-3 text-secondary text-decoration-none d-inline" style="font-weight: bold ">IIUM SECOND-HAND ONLINE SHOP</a>
    <form action="/sell" class="d-flex" role="search">
      <input class="form-control me-2 me-2" type="search" placeholder="Search for Item or User" aria-label="Search">
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


  