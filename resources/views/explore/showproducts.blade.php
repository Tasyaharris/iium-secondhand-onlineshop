@if(session()->has('success'))
<div class="alert alert-success d-flex align-items-center" role="alert">
  {{ session('success') }}
  <button type="button" id="closeBtn" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
</button>
</div>
@endif

<div class="row g-2" style=" background-color: white;  border: none;min-height: 50vh;display: flex; align-items: center; justify-content: center;">
  @forelse ($products as $product)
  <div class="col">
    <div   class="card mx-4 mb-3" style="border-radius: 10px;margin-top:50px;width: 210px; height: 290px; ">

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
  @empty
  <div class="col">
      <h6 style="color:grey;text-align:center;align-items:center;">No product</h6>
  </div>
  @endforelse
</div>

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
             //console.log('Liked:', liked);

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
