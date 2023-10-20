<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    

  </head>
  <body>

    @include('partials.navbar')
    
    <div>

        <div class="filter_text">
            <!-- THE FILTERING TEXT-->
            <h6>FILTER TEXT HERE</h6>
        </div>

        <div class="img">

        </div>

        <div class="row g-2">
          
            
            <div class="col-md-3">
    
                <div class="card p-2 py-3 text-center">
                  
                    <div class="img">
                        @if ($product->product_pic)
                        <img src="{{ asset('storage/' . $product->product_pic) }}" width="70" class="rounded-circle">
                        @endif
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
    
                </div>
                
            </div>
                
          
            
            
  
          </div>
    </div>


    
    @include('partials.footer')
  </body>
</html>