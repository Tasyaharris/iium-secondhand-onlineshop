
<section class="explore border-bottom mt-0" id="explore" style="background-color: white; height: auto;">
  <div class="max-width">
    <div class="explore-content">
      <div class="text-1">
        <p class= "p-3"  style ="font-weight: bold; font-size:20px"> FOR FREE </p>
      </div>
      <div id="carouselExampleFade" class="carousel slide" style="height: 350px;">
        <div class="carousel-inner">
            @foreach ($products1->chunk(4) as $chunk)
                <div class="carousel-item{{ $loop->first ? ' active' : '' }}">
                    <div class="carousel" href="/products.viewproduct" id="myCarousel">
                      @foreach ($chunk as $product)
                            <div class="col" style="margin-left:55px;">
                                <div class="card mx-4 mb-3" style="width: 200px; height: 310px; flex: 0 0; ">
                                    <!-- Product details -->
                                    <a class="card-body" href="{{ route('products.show', $product->id) }}">
                                      <div class="username mb-0">
                                          <h6>{{ $product->user_name }}</h6>
                                      </div>
                                    
                                        <a class="img text-center mt-0 mb-4" href="{{ route('products.show', $product->id) }}">
                                          @if (is_array(json_decode($product->product_pic)))
                                          @php $firstImagePath = json_decode($product->product_pic)[0]; @endphp
                                                    <div class=" img_recom" style="margin-left: 3px; margin-bottom:0px">
                                                        <img src="{{ asset('storage/' . $firstImagePath) }}"width="100" height="100" >
                                                    </div>
                                                
                                          @endif
                                        </a>
    
                                        <div class="prod-desc">
                                            <h6 id="product_name">{{ $product->product_name }}</h6>
  
                                            <small id="condition">{{ $product->condition_name }}</small>
                                            <br>
                                            
                                            <form method="post" action="{{ url('likeprodutc') }}" id="addLike">
                                              @csrf
                                              <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}  ">
                                              <button type="submit" class="heart-button" data-product-id="{{ $product->id }}" style="cursor: pointer; border: none; background: none;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="black" class="bi-heart-fill liked-heart" viewBox="-1 -1 18 14" id="heart-icon">
                                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                </svg>
                                            </button>                                            
                                            </form>
                    
                                            
                                        </div>
                                      
                                       
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev custom-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev" >
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
          </svg>
        </button>

        <button class="carousel-control-next custom-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next"> 
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
          </svg>
        </button>
    </div>

     
    </div>
   
    
  </div>
  </div>

</section>

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
             url: "{{ url('likeproduct') }}",
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