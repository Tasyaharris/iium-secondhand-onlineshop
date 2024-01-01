
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/footer.css">
    {{-- @vite('resources/css/app.css') --}}
  </head>
  <body>

      @include('partials.navbar')
      @include('partials.explore') 

      @if(!isset($search))
      
        @include('partials.recommended')
        @include('partials.forfree')
      @else
      
        @include('partials.searching')
      @endif
     
    

      <div class="container mt-2">
      
      @yield('container')

      </div>

      
      @include('partials.footer')

      @vite('resources/js/app.jsx')
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      {{-- <script>
        document.addEventListener("DOMContentLoaded", function(event){
          Echo.channel(`hello-channel`)
          .listen('HelloEvent', (e) => {
            console.log('Event from hello');
         console.log(e);
          });
        });
       
    </script> --}}

{{-- <script>
    window.onload=function(){
  var channel =  Echo.channel(`hello-channel`);
  channel.listen('HelloEvent', (e) => {
            console.log('Event from hello');
         console.log(e);
          });
        }
</script>
     --}}

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