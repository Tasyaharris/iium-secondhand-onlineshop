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
                <td class="clickable-row active {{ Request::is('listings') ? 'active' : ' ' }}"  data-href="/listings">
                  <a href="/listings">My Listings</a>
                </td>
                <td class="clickable-row {{ Request::is('reviews') ? 'active' : ' ' }}" data-href="/reviews">
                  <a href="/reviews">Reviews</a>
                </td>
                <td class="clickable-row {{ Request::is('cart') ? 'active' : ' ' }}" data-href="/cart">
                  <a href="/cart">My Cart</a>
                </td>
                <td class="clickable-row {{ Request::is('myorder') ? 'active' : ' ' }}" data-href="/myorder">
                  <a href="/myorder">My Order</a>
                </td>
              </tr>
            </table>
            </div>
          </nav>

          <nav class="side-navbar1" style="margin-left:10px;padding:0px; display:inline-block;">
            <div class="order-title" style="display: inline-flex;">
            <h5 style="margin-top:10px; text-align:center; margin-left: 45px; ">My Listings</h5>
            <!-- Your sidebar content goes here -->
            <div class="table-container1" style="margin-left:40px;">
            <table class="selection1" >
              <tr>
                <td class="clickable-row  {{ Request::is('listings') ? 'active' : ' ' }}"  data-href="/listings">
                  <a href="/listings">Sold</a>
                </td>
                <td class="clickable-row {{ Request::is('reviews') ? 'active' : ' ' }}" data-href="/reviews">
                  <a href="/reviews">Cancelled</a>
                </td>
                <td class="clickable-row {{ Request::is('cart') ? 'active' : ' ' }}" data-href="/cart">
                  <a href="/cart">Completed</a>
                </td>
              </tr>
            </table>
            </div>
          </div>
          </nav>

          <div class="container-under-table">
            <!-- Your container content under the table goes here -->
            <div class="selection-title">
                <h5>Listings</h5>
            </div>
            
            <div class="products-listing">
              <div class="row g-2" >
                @foreach ($products as $product)
                <div class="col">
                    <div class="card  text-center mb-3 " style="width: 210px; height: 290px;">
                      <div class="card-body d-flex flex-column">
                        <div class="img text-center mb-1">
                            @if ($product->product_pic)
                            @if (is_array(json_decode($product->product_pic)))
                            <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                              <div class="carousel-inner">
                                  @foreach(json_decode($product->product_pic) as $index => $imagePath)
                                      <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                          <img src="{{ asset('storage/' . $imagePath) }}"width="100" height="100"  alt="Image {{ $index + 1 }}">
                                      </div>
                                  @endforeach
                              </div>
                            </div>
                            @else
                            <img src="{{ asset('storage/' . $product->product_pic) }}" width="100" height="100">
                            @endif
                           @endif
                        </div>
                        
                        <div class="prod-desc mt-1 flex-grow-1">
                        <h6 id="product_name" >{{ $product->product_name }}</h6>
                        <small id="price" id="price" > RM {{ $product->product_price }}</small>
                        <small id="seller_option"> ({{ $product->nego_option }})</small>
                        <br>
                        <small id="condition">{{ $product->condition_name }}</small>    
                       
                        </div>
                      
                        <br>
                        
                        <!--like-->
                  
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="black"  class="bi bi-heart-fill" viewBox="-1 -1 18 14"  id="heart-icon">
                          <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                        </svg>

  

                        <div class="options">
                           <div class="dropdown ms-auto">
                            <i class="fas fa-ellipsis-vertical" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu">
                              <li>
                                 <!--update item button-->

                                  <!--update item button-->
                                  <span class="dropdown-item">
                                    <a href="{{ route('sell.edit', $product->id) }}" class="fas fa-pen mx-2"></a> Update
                                  </span>
                                </li>
                                <li>
                                  </span>
                           
                              
                              </li>
                              <li>
                                <!--delete item button-->
                              
                                  <form action="{{ route('sell.destroy', $product->id) }}"  method="post">
                                    <span class="dropdown-item">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" onclick="return confirm('Are you sure to delete this item?')" style="border: none; background-color: white;">
                                      <i class="fas fa-trash mx-2"></i> Delete
                                    </button>
                                    </span>
                                  </form>
                                
                              </li> 
                            </ul>
                        </div>
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
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Get all heart icons on the page
        var heartIcons = document.querySelectorAll('.bi-heart-fill');
    
        // Add a click event listener to each heart icon
        heartIcons.forEach(function(heartIcon) {
          heartIcon.addEventListener('click', function() {
            // Get the path element inside the clicked heart icon
            var heartPath = this.querySelector('path');
    
            // Check the current color and toggle between red and the default color
            if (heartPath.style.fill === 'red') {
              heartPath.style.fill = 'none';
              heartPath.style.stroke = 'black';
            } else {
              heartPath.style.fill = 'red';
              heartPath.style.stroke = 'red';
            }
          });
        });
      });
    </script>
  </body>
</html>