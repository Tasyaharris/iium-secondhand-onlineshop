<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/footer.css">
  </head>
  <body>

      @include('partials.navbar')

      <!--success messages; later will be replaced with pop up alert/messages-->
      @if(session()->has('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif
   
      <div class="row g-3">
        <div class="col-md-4">
          <div class="user-profile">
            <div class="user-info">
              @foreach ($profiles as $profile)
              <div class="flex-container">
                <img  class="profile-picture" src="images/books.png" alt="User Profile Picture">
                <div class="uname">
                  <div class="nameuser">
                    <h6 >{{ $profile->first_name }} </h6>
                    <h6>{{ $profile->last_name }}</h6>
                  </div>
                 
                  <p>{{ auth()->user()->username }}</p>
                </div>
              </div>
              <br>
                <div class="location">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                </svg> 
                <p>{{ $profile->mahallah }}</p>
                </div>
              @endforeach
            </div>
          </div>
          
        </div>

        <div class="col-md-8">
          <nav class="side-navbar">
            <!-- Your sidebar content goes here -->
            <div class="table-container">
            <table class="selection">
              <tr>
                <td class="clickable-row  {{ Request::is('profile') ? 'active' : ' ' }}"  data-href="/listings">
                  <a href="/profile">My Listings</a>
                </td>
                <td class="clickable-row {{ Request::is('reviews') ? 'active' : ' ' }}" data-href="/reviews">
                  <a href="/reviews">Reviews</a>
                </td>
                <td class="clickable-row {{ Request::is('cart') ? 'active' : ' ' }}" data-href="/cart">
                  <a href="/cart">My Cart</a>
                </td>
                <td class="clickable-row active{{ Request::is('myorder') ? 'active' : ' ' }}" data-href="/myorder">
                  <a href="/order">My Order</a>
                </td>
              </tr>
            </table>
            </div>
          </nav>

          <nav class="side-navbar1" style="margin-left:10px;padding:0px; display:inline-block;">
            <div class="order-title" style="display: inline-flex;">
            <h5 style="margin-top:20px; text-align:center; margin-left: 45px; ">My Order</h5>
            <!-- Your sidebar content goes here -->
            <div class="table-container1" style="margin-left:52px;">
            <table class="selection1" >
              <tr>
                <td class="clickable-row {{ Request::is('delivery') ? 'active' : ' ' }}" data-href="/listings" style="width: 139px; ">
                  <a class="navbar-brand" href="/delivery" style="display: block; text-align: center; margin: 0; padding: 0; font-size:15px;">
                      <img src="/images/delivery.png" alt="logo" width="30" height="30" style="display: block; margin: 0 auto;">
                      Delivery
                  </a>
              </td>
              <td class="clickable-row {{ Request::is('receive') ? 'active' : ' ' }}" data-href="/reviews" style="width: 139px; ">
                  <a class="navbar-brand" href="/receive" style="display: block; text-align: center; margin: 0; padding: 0; font-size:15px;">
                      <img src="/images/receive.png" alt="logo" width="30" height="30" style="display: block; margin: 0 auto;">
                      Receive
                  </a>
              </td>
              <td class="clickable-row {{ Request::is('completed') ? 'active' : ' ' }}" data-href="/cart" style="width: 139px; ">
                  <a class="navbar-brand" href="/completed" style="display: block; text-align: center; margin: 0; padding: 0; font-size:15px;">
                      <img src="/images/completed.png" alt="logo" width="30" height="30" style="display: block; margin: 0 auto;">
                      Completed
                  </a>
              </td>
              <td class="clickable-row {{ Request::is('cancelled') ? 'active' : ' ' }}" data-href="/myorder" style="width: 139px; ">
                  <a class="navbar-brand" href="/cancelled" style="display: block; text-align: center; margin: 0; padding: 0; font-size:15px;">
                      <img src="/images/cancel.png" alt="logo" width="30" height="30" style="display: block; margin: 0 auto;">
                      Cancelled
                  </a>
              </td>
              </tr>
            </table>
            </div>
          </div>
          </nav>

          <div class="container-under-table">
            <!-- Your container content under the table goes here -->
            <div class="selection-title">
               
            </div>
            
            <div class="products-listing">
              <div class="row g-2" >
               
            
                
      
              </div>
        

            </div>
          </div>
       
        </div>

      </div>
      
      
      
    
      @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>