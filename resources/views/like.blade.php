<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/profile.css">
    

  </head>
  <body>

    @include('partials.navbar')

    <br>

   
      <div class="row g-2" style=" background-color: white;  border: none;min-height: 50vh;margin-left:80px;">
      @foreach ($products as $product)
      <div class="col">
        <div class="card mx-4 mb-3" style="border-radius: 10px;margin-top:20px;width: 210px; height: 290px; ">
  
          <div class="username">
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
  
          <div class="prod-desc mt-1 flex-grow-1">
            <h6 id="product_name" >{{ $product->product_name }}</h6>
            <small id="price" id="price" > RM {{ $product->product_price }}</small>
            <small id="seller_option"> ({{ $product->nego_option }})</small>
            <br>
            <small id="condition">{{ $product->condition_name }}</small>    
            <br>

            <form method="post" action="{{ url('likes') }}" id="addLike">
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

    
    @include('partials.footer')
   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
  $(document).ready(function() {
      // Function to get liked status from localStorage for a specific product and user
      function getLikedStatus(productId, userId) {
          return localStorage.getItem('liked_' + userId + '_' + productId) === 'true';
      }

      // Function to set liked status in localStorage for a specific product and user
      function setLikedStatus(productId, userId, liked) {
          localStorage.setItem('liked_' + userId + '_' + productId, liked);
      }

      @auth
          var authUserId = {{ auth()->user()->id }};
          // Set the initial heart icon color for each item based on the liked status
          $('.bi-heart-fill').each(function() {
              var productId = $(this).closest('.heart-button').data('product-id');
              var liked = getLikedStatus(productId, authUserId);
              if (liked) {
                  $(this).attr('fill', 'red');
                  $(this).attr('stroke', 'red');
              }
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

                      // Change the heart color based on the result
                      var heartIcon = clickedButton.find('.bi-heart-fill');
                      heartIcon.attr('fill', liked ? 'red' : 'white');
                      heartIcon.attr('stroke', liked ? 'red' : 'black');

                      // Store the liked status in localStorage for this specific product and user
                      setLikedStatus(productId, authUserId, liked);
                  }
              });
          });
      @endauth
  });
</script>

  
  </body>
</html>