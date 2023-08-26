@extends('layouts.headerlogin')

@section('container')

<div class="box1 w-100 m-auto">
    <div class="logo">
        <img class="mb-2" src="images/logo.png" alt="logo" width="65" height="57">
    </div>
    <div class="text">
        <h5 style="text-align: center">IIUM SECOND-HAND ONLINE SHOP</h5>
    </div>
</div>

<main class="form-signin">
    <div class="center-regis">
        <div class="title">
            <p style="font-weight: bold">SIGN UP</p>
        </div>
        
        <form action="/register" method="post">
        @csrf
            <div class="form-floating">
              <input type="text"  name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" required value="{{ old('username') }}">
              <label for="username">Username</label>
               @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
               @enderror
            </div>
            <div class="form-floating">
                <input type="email" name="email" id="email"  class="form-control @error('email') is-invalid @enderror"  placeholder="name@example.com" required value="{{ old('email') }}">
                <label for="email">Email Address</label>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                 </div>
                @enderror
              </div>
            <div class="form-floating">
              <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror"  placeholder="Password" required >
              <label for="password">Password</label>
              @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
               @enderror
            </div>
            <div class="form-floating">
                <input type="password" name="confirm_password" id="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"   placeholder="Confirm Password" required >
                <label for="cpassword">Confirm Password</label>
                @error('confirm_password')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
               @enderror
            </div>
        
            
            <button class="button" type="submit" style="border-radius: 5px; font-weight: bold;">REGISTER</button>
            
            
          </form>

          <div class="text1">
            <small class="d-block text-center"> Already have an account?<a href="/login"> Login </a></small>
          </div>

        
    </div>

    
  </main>
@endsection

