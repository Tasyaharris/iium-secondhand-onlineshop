<nav class="navbar navbar-expand-lg navbar-dark mb-0" style="background-color: #006d77;">
    <div class="container-fluid">
      <a class="navbar-brand1" href="/">
        <img src="/images/logo.png" alt="logo" width="50" height="50">
      </a>
      
      <a href="/homepage" class=" p-3 text-decoration-none d-inline" style="font-weight: bold; color:white; ">IIUM SECOND-HAND ONLINE SHOP</a>
     
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto" >
         @auth
           <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->username }}
             </a>
              <ul class="dropdown-menu">
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


  