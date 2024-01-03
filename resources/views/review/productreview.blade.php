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
  <body style="min-height: 100vh;">

      @include('partials.navbar')

      <div class="row g-3" style="min-height: 100vh;">
        @include('myorder.profilesbar')

        <div class="col-md-8">
          <nav class="side-navbar">
            <!-- Your sidebar content goes here -->
            <div class="table-container">
            <table class="selection">
              <tr>
                <td class="clickable-row {{ Request::is('listings') ? 'active' : ' ' }}" onclick="window.location='/profile'">
                  <a href="/profile">My Listings</a>
              </td>
              <td class="clickable-row {{ Request::is('productreview') ? 'active' : ' ' }}" onclick="window.location='/productreview'">
                  <a href="/productreview">Reviews</a>
              </td>
              <td class="clickable-row {{ Request::is('cart') ? 'active' : ' ' }}" onclick="window.location='/cart'">
                  <a href="/cart">My Cart</a>
              </td>
              <td class="clickable-row {{ Request::is('myorder') ? 'active' : ' ' }}" onclick="window.location='/myorder'">
                  <a href="/myorder">My Order</a>
              </td>
              </tr>
            </table>
            </div>
          </nav>

          <p class="subtitle" style="margin-left:10px;">
            <h5 style="margin-left:10px; margin-bottom:10px;">Reviews</h5>
          </p>
          
          <div class="container-under-table" style="min-height: 50vh;">
            <div class="products-listing">
              <div class="row g-2" >
                @forelse ($order_items as $order_item)
                <div class="col">
                  <div class="card  text-center " style="width: 670px; height: auto;">
                      <div class="card-body d-flex flex-column">
                        <h6 id="product_name" style="text-align: left;">{{  $order_item->product->product_name }}</h6>
                        <div class="item-order mt-1" style="display: flex; align-items: center; margin-left:10px; ">
                        <div class="img text-center mb-1">
                          @if ($order_item->product->product_pic)
                          @if (is_array(json_decode($order_item->product->product_pic)))
                          <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach(json_decode($order_item->product->product_pic) as $index => $imagePath)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $imagePath) }}"width="70" height="70"  alt="Image {{ $index + 1 }}">
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
                        <small id="seller_option"> ({{ $order_item->product->nego->option }})</small>
                        <br>
                        <small id="condition">{{ $order_item->product->condition->condition }}</small>    
                        </div>
                      </div>

                        <div class="review mt-2 flex-grow-1">
                          <div class="rating-css">
                          <small style="font-weight: bold;">Product Rating:  </small>
                          <small>{{ $order_item->review->rating }}/5</small>
                          <br>
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
                          <small id="comment" style="font-weight: bold;">Comment: </small>
                          <small>{{ $order_item->review->comment }}</small>
                            
                          </div>
                          <div class="seller-css">
                            <small style="font-weight: bold">Seller Rating:  </small>
                            <small>{{ $order_item->review->services }}/5</small>
                            <br>
                            @php
                            $sellerRating = $order_item->review ? $order_item->review->services : 0;
                            @endphp
  
                           @for ($i = 1; $i <= $maxStars; $i++)
                            @if ($i <= $sellerRating)
                              <i class="fas fa-star checked" value="{{ $i }}" name="seller_rating[{{ $order_item->id }}]" id="services{{ $i }}_{{ $order_item->id }}"></i>
                            @else
                              <i class="fas fa-star" value="{{ $i }}" name="seller_rating[{{ $order_item->id }}]" id="services{{ $i }}_{{ $order_item->id }}"></i>
                            @endif
                          @endfor
   
                          </div>


                        </div>
                      
                        <br>
                      </div> 
                    </div>
                </div>
                @empty
                <div class="col">
                    <h6 style="color:grey;text-align:center;align-items:center;">No product review</h6>
                </div>
              @endforelse
            
              </div>
            </div>

            
              </div>
             

        
       
        </div>

      </div>
      
      
      
    
      @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


      
  </body>
</html>