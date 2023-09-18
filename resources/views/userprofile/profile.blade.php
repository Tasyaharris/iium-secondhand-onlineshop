<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/footer.css">
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
                <td class="clickable-row active {{ Request::is('listings') ? 'active' : ' ' }}"  data-href="/listings">
                  <a href="/listings">My Listings</a>
                </td>
                <td class="clickable-row {{ Request::is('reviews') ? 'active' : ' ' }}" data-href="/reviews">
                  <a href="/reviews">Reviews</a>
                </td>
                <td class="clickable-row {{ Request::is('cart') ? 'active' : ' ' }}" data-href="/cart">
                  <a href="/cart">My Cart</a>
                </td>
                <td class="clickable-row {{ Request::is('order') ? 'active' : ' ' }}" data-href="/order">
                  <a href="/order">My Order</a>
                </td>
              </tr>
            </table>
            </div>
          </nav>

          <div class="container-under-table">
            <!-- Your container content under the table goes here -->
            <div class="selection-title">
                <h5>Listings</h5>
            </div>
            
            <div class="products-listing">
              <div class="row g-2">
                @foreach ($products as $product)
                <div class="col-md-3">
        
                    <div class="card p-2 py-3 text-center">
                      
                        <div class="img mb-2 ">
        
                            <img src="https://i.imgur.com/LohyFIN.jpg" width="70" class="rounded-circle">
                            
                        </div>
                        
                        <div class="prod-desc">
                        <h6 id="product_name" >{{ $product->product_name }}</h6>
                        <small id="price" id="price" > RM {{ $product->product_price }}</small>
                        <small id="seller_option"> ({{ $product->nego_option }})</small>
                        <br>
                        <small id="condition">{{ $product->condition_name }}</small>    
                       
                        </div>
                      
                      <br>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16" style="margin-left: 10px">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                      </svg>
                        <div class="options">
                           <div class="dropdown ms-auto">
                            <i class="fas fa-ellipsis-vertical" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu">
                              <li>
                                 <!--update item button-->
                                <span class="dropdown-item">
                                  <i class="fas fa-pen mx-2"></i> Update
                                </span>
                              </li>
                              <li>
                                <!--delete item button-->
                                <span class="dropdown-item">
                                  <form action="/sell" method="post">
                                    @method('delete')
                                    @csrf
                                    <i class="fas fa-trash mx-2" onclick="return confirm('Are you sure to delete this item?')"></i> Delete
                                  </form>
                                </span>
                              </li> 
                            </ul>
                        </div>
                        </div>
                    </div>
                    
                </div>
                    
                @endforeach
                
                
      
              </div>
        

            </div>
          </div>
       
        </div>

      </div>
      
      
      
    
      @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>