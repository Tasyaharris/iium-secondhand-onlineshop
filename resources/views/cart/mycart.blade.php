<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="css/cart.css">

    <link rel="stylesheet" href="/css/footer.css">
  </head>
  <body>

      @include('partials.navbar')

        <!--error messages-->
        @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
          {{ session('error') }}
        </div>
        @endif

      <div class="row g-3">
        <div class="col-md-4">
          <div class="user-profile">
            <div class="user-info">
              @foreach ($profiles as $profile)
              <div class="flex-container">
                <img  class="profile-picture" src="images/books.png" alt="User Profile Picture" width="50" height="50">
                <div class="uname">
                  <div class="nameuser">
                    <h6 >{{ $profile->first_name }} </h6>
                    <h6>{{ $profile->last_name }}</h6>
                  </div>
                 
                  <p> @ {{ auth()->user()->username }}</p>
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
                <td class="clickable-row active {{ Request::is('cart') ? 'active' : ' ' }}" data-href="/cart">
                  <a href="/cart">My Cart</a>
                </td>
                <td class="clickable-row {{ Request::is('myorder') ? 'active' : ' ' }}" data-href="/myorder">
                  <a href="/order">My Order</a>
                </td>
              </tr>
            </table>
            </div>
          </nav>

          <p class="subtitle" style="margin-left:10px;">
            <h5 style="margin-left:10px; margin-bottom:10px;">My Cart</h5>
          </p>
          


          <div class="container-under-table">
           
            
            <div class="products-listing">
              <div class="row g-2" >

                <nav class="navbar bg-body-tertiary mt-0" style="border:1px solid grey;">
                  <div class="discussion-bar">
                      <!--seller profile-->
                      @if(count($carts) > 0)
                      <div class="address1" style="display: inline-block; margin-bottom:20px; margin-top:10px; margin-left:10px;">
                          <div style="text-align: center;">
                              <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                                  class="bi bi-shop" viewBox="0 0 16 16" style="margin-left: 10px;">
                                  <path
                                      d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                              </svg>
                              <a class="p-3 text-decoration-none d-inline" style="font-weight: bold; color: black;">{{$carts[0]->product->user->username}}</a>
                          </div>
                          <div style="text-align: center;">
                          </div>
                      </div>
                      @endif
              
                      @foreach($carts as $cart)
                      <div class="product" style="display: flex; align-items: center; margin-bottom:20px;">
                          <!--product details-->
                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" style="margin-left:1px;">
                              <label class="form-check-label" for="flexCheckDefault">
                              </label>
                              <!--hidden to pass the productid data-->
                              <input type="hidden" name="selected_products[]" value="{{ $cart->product->id }}">
                          </div>
              
                          <div class="col text-center" style="margin-left: 18px; ">
                              @if (is_array(json_decode($cart->product->product_pic)))
                              @php $firstImagePath = json_decode($cart->product->product_pic)[0]; @endphp
                              <div class=" img_recom" style="margin-left: 3px; margin-bottom:0px">
                                  <img src="{{ asset('storage/' . $firstImagePath) }}" width="90" height="90">
                              </div>
                              @endif
                          </div>
              
                          <div class="col" style="display: flex; align-items:center;">
                              <small style="flex-basis: 60%; width: 250px; margin-left:5px;margin-right: 30px; font-weight: bold; font-size:15px;">
                                  {{ $cart->product->product_name }}</small>
                              <small style="flex-basis: 60%; margin-right: 30px;font-size:15px;">RM{{ $cart->product->product_price }}
                              </small>

                          
                              <form action="{{ route('cart.destroy', $cart->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                  <button type="submit" style="border: none; background-color: white; margin-right:10px;display:flex;">
                                    <i class="fas fa-trash mx-2"></i> Delete
                                  </button>
                              </form>      
                      
                          </div>
                          
                        </div>
                        @endforeach
              
                  </div>
              </nav>
              
              </div>
            </div>

                <div class="col mt-3" style="display: flex;">
                  <div class="totalPrice d-flex align-items-center" >
                    <h6 style="margin-left:5px;">Total Price: RM</h6>
                  </div>
                  <a id="checkoutBtn" href= "#" class="btn_items" style="text-decoration:none; color:black; justify-items:center;margin-left:14px;">Checkout</a>
                </div>
              </div>
             

        
       
        </div>

      </div>
      
      
      
    
      @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
      // JavaScript code to handle the Checkout button click event
      document.getElementById('checkoutBtn').addEventListener('click', function() {
          // Get all selected checkboxes
          var selectedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  
          // Extract product ids from selected checkboxes
          var productIds = Array.from(selectedCheckboxes).map(function(checkbox) {
              return checkbox.nextElementSibling.nextElementSibling.value;
          });
  
          // Construct the URL with the selected product ids
          var checkoutUrl = "{{ url('show_items') }}/" + productIds.join(',');

          
          // Redirect to the checkout URL
          window.location.href = checkoutUrl;
      });
    </script>
      
  </body>
</html>