
<section class="header border-bottom mt-0" id="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-0">
      <div class="container-fluid">
        <a class="navbar-brand" href="/homepage">
          <img src="images/logo.png" alt="logo" width="40" height="40" alt="Logo">
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
                 <li><a class="dropdown-item" href="#">Profile</a></li>
                 <li><hr class="dropdown-divider"></li>
                 <li><a class="dropdown-item" href="#">Settings</a></li>
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