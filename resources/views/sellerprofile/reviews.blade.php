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
      <div class="row g-3">
        <div class="col-md-4">
          
          <div class="user-profile">
            <div class="user-info">
              <div class="flex-container">
                <img  class="profile-picture" src="images/books.png" alt="User Profile Picture">
                @if($profile)
                <div class="uname">
                  <div class="nameuser">
                    <h6 >{{ $profile->first_name }} </h6>
                    <h6>{{ $profile->last_name }}</h6>
                  </div>
                </div>
                @endif
              </div>
              <br>
                @if($profile)
                <div class="location">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                </svg> 
                <p>{{ $profile->mahallah }}</p>
                </div>
                @endif
            </div>
          </div>  
          
        </div>

        <div class="col-md-8">
            <nav class="side-navbar">
              <!-- Your sidebar content goes here -->
              <div class="table-container">
              <table class="selection">
                <tr>
                  <td class="clickable-row {{ Request::is('sellerprofile') ? 'active' : ' ' }}"  data-href="{{ route('sellerprofile.show',$user->id) }}">
                    <a href="{{ route('sellerprofile.show',$user->id) }}">Products</a>
                  </td>
                  <td class="clickable-row active{{ Request::is('reviews') ? 'active' : ' ' }}" data-href="/sellerreviews/{{ $user->id }}">
                    <a href="/sellerreviews/{{ $user->id }}">Reviews</a>
                  </td>
                  
                </tr>
              </table>
              </div>
            </nav>

            
        <div class="container-under-table" style="">
            <!-- Your container content under the table goes here -->
            <div class="products-listing">
                <div class="row g-2" >
                  <div container style=" background-color: white;  border: none;min-height: 50vh;display: flex; align-items: center; justify-content: center;">
                   @forelse ($order_items as $order_item)
                  <div class="col">
                    <div class="card  text-center " style="width: 670px; height: auto;">
                        <div class="card-body d-flex flex-column">
                         <h6 id="buyer_name" style="text-align: left;">{{  $order_item->order->user->username }}</h6>
                         <div class="review" style="text-align:left;">
                         <div class="rating-css">
                            {{ $order_item->review->rating }}/5
                            @php
                              $maxStars = 5;
                              $productRating = $order_item->review ? $order_item->review->rating : 0;
                            @endphp
  
                            @for ($i = 1; $i <= $maxStars; $i++)
                              @if ($i <= $productRating)
                                <i class="fas fa-star checked" value="{{ $i }}" name="product_rating[{{ $order_item->id }}]" id="rating{{ $i }}_{{ $order_item->id }}"></i>
                              @else
                                <i class="fas fa-star" value="{{ $i }}" name="product_rating[{{ $order_item->id }}]" id="rating{{ $i }}_{{ $order_item->id }}"></i>
                              @endif
                            @endfor
                          </div>
                            <div class="comment">
                            <small>{{ $order_item->review->comment }}</small>
                            </div>
                         </div>
                         <div class="container-product mt-2" style="border: 1px solid black;">
                          <div class="name" style="text-align: left;margin-left:5px;">
                          <small id="product_name" style="font-weight:bold;">{{  $order_item->product->product_name }}</small>
                         </div>
                          <div class="item-order mt-1" style="display: flex; align-items: center; margin-left:10px; ">
                          <div class="img text-center mb-1">
                            @if ($order_item->product->product_pic)
                            @if (is_array(json_decode($order_item->product->product_pic)))
                            <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                              <div class="carousel-inner">
                                  @foreach(json_decode($order_item->product->product_pic) as $index => $imagePath)
                                      <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                          <img src="{{ asset('storage/' . $imagePath) }}"width="30" height="30"  alt="Image {{ $index + 1 }}">
                                      </div>
                                  @endforeach
                              </div>
                            </div>
                            @else
                            <img src="{{ asset('storage/' . $order_item->product->product_pic) }}" width="100" height="100">
                            @endif
                           @endif
                          </div>
                          
                          <div class="row product-desc ma-auto" style="display: flex; justify-content: left; text-align:left; margin-left:7px;">
                          <small id="price" > RM {{ $order_item->product->product_price}}</small>
                          </div>
                        </div>
                        </div>
                        </div> 
                      </div>
                  </div>
                  @empty
                  <div class="col">
                      <h6 style="color:grey;text-align:center;align-items:center;">No review</h6>
                  </div>
                  @endforelse
                  </div>
                </div>
              </div>
          
        </div>
        </div>

        

      </div>

      
      @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
<script>
  $(document).ready(function() {
     // Function to get liked status from localStorage for a specific product
     function getLikedStatus(productId) {
         return localStorage.getItem('liked_' + productId) === 'true';
     }
 
     // Function to set liked status in localStorage for a specific product
     function setLikedStatus(productId, liked) {
         localStorage.setItem('liked_' + productId, liked);
     }
 
     // Set the initial heart icon color for each item based on the liked status
     $('.bi-heart-fill').each(function() {
         var productId = $(this).closest('.heart-button').data('product-id');
         var liked = getLikedStatus(productId);
         $(this).attr('fill', liked ? 'red' : 'white');
         $(this).attr('stroke', liked ? 'red' : 'black');
     });
 
     $(document).on('click', '.heart-button', function(event) {
         event.preventDefault();
 
         // Store the value of 'this' in a variable
         var clickedButton = $(this);
 
         // Retrieve the product ID from the data attribute
         var productId = clickedButton.data('product-id');
 
         $.ajax({
             url: "{{ url('likes') }}",
             data: { product_id: productId, _token: "{{ csrf_token() }}" },
             type: 'post',
             success: function(result) {
                 var liked = result.liked;
 
                 // Log the value of 'liked' to check if it's being correctly set
                 console.log('Liked:', liked);
 
                 // Change the heart color based on the result
                 var heartIcon = clickedButton.find('.bi-heart-fill');
                 heartIcon.attr('fill', liked ? 'red' : 'white');
                 heartIcon.attr('stroke', liked ? 'red' : 'black');
 
                 // Store the liked status in localStorage for this specific product
                 setLikedStatus(productId, liked);
             }
         });
     });
 });
 
 </script>
 
  </body>
</html>