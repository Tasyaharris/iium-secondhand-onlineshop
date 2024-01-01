@extends('layouts.headerlogin')

@section('container')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session()->has('loginError'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ session('loginError') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="box1 flex-grow-1 w-100 m-auto">
    <div class="logo">
        <img class="mb-2" src="images/logo.png" alt="logo" width="65" height="57">
    </div>
    <div class="text">
        <h5 style="text-align: center">IIUM SECOND-HAND ONLINE SHOP</h5>
    </div>
</div>


<main class="form-signin flex-grow-1 w-100 m-auto mt-4 mb-4">
    <div class="center mb-3">
        <div class="title">
            <p style="font-weight: bold">USER LOGIN</p>
        </div>
        
        <form action="/login" method="post" >
          @csrf
            <div class="form-floating">
              <input type="username"  name="username" class="form-control @error('email') is-invalid @enderror" id="username" placeholder="username" autofocus required value="{{ old ('username') }}">
              <label for="floatingInput">Username</label>
              @error('username')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-floating">
              <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
              <label for="floatingPassword">Password</label>
            </div>
        
            
            <button class="button" type="submit" style="border-radius: 5px; font-weight: bold;">LOGIN</button>
            
            
          </form>

          <div class="text1">
            <small class="d-block text-center"> Don't have an account yet?<a href="/register"> Create an account</a></small>
          </div>
         
    </div>

    
  </main>
  
  @vite('resources/js/app.jsx')
  {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>

const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    function getCookie(name){
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) {
            return parts.pop().split(';').shift();
        }
    }

    function request(url, options){
        const csrfToken = getCookie('XSRF-TOKEN');
        return fetch(url, {
            headers: {
                'content-type': '{{ csrf_token() }}',
                'accept': '{{ csrf_token() }}',
                'X-XSRF-TOKEN': decodeURIComponent(csrfToken),
            },
            credentials: 'include',
            ...options,
        })
    }

    // Make a request to get the CSRF token before the login request
    axios.get('/sanctum/csrf-cookie', {
        headers: {
            'content-type': 'application/json',
            'accept': 'application/json'
        },
        credentials: 'include'
    }).then(response => {
        // Login...
        login();
    }).catch(error => {
        console.error('Error getting CSRF token:', error);
    });

    function login(){
        request('{{ route('login.trigger') }}', {
            method: 'POST',
            body: JSON.stringify({
            username: username,
            password: password
            })
        })
        .then(response => {
            // Handle the login response...
        })
        .catch(error => {
            console.error('Login error:', error);
        });
    }
</script> --}}
 
@endsection


