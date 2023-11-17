<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/products.css">
    

  </head>
  <body>

    @include('partials.navbar')
    <br>
    
    <div>

        <div class="filter_text" style="margin-left:30px;">
            <!-- THE FILTERING TEXT-->
            <h5 id="category_id" >{{ $product->category->name}} >> {{ $product->subcategory->name }}</h5>
           
        </div>


        <br>

       <div class="container mt-2">

        <div class="row">
        
          <div class="text-center">
            @if ($product->product_pic)
            @if (is_array(json_decode($product->product_pic)))
            <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel" style="width: 250px; margin: 0 auto;">
                <div class="carousel-inner" style="height: 250px;">
                    @foreach(json_decode($product->product_pic) as $index => $imagePath)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $imagePath) }}" width="200" height="200" class="img-fit" alt="Image {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#imageCarousel" role="button" data-bs-slide="prev" style="margin-left: -23px;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                  </svg>
                </a>
                <a class="carousel-control-next" href="#imageCarousel" role="button" data-bs-slide="next" style="margin-left: 100px;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                  </svg>
                </a>
            </div>
                @else
                    <img src="{{ asset('storage/' . $product->product_pic) }}" width="200" height="200">
                @endif
            @endif
        </div>
        
        
        

          <div class="col-md-6 mt-5 mb-5">
           
            <div class="prod-desc">
              <h4 id="product_name" >{{ $product->product_name }}</h4>
              <small id="price" name="price" style="font-weight: bold; font-size:20px"> RM {{ $product->product_price }}</small>
              <small id="seller_option" style="font-size:20px"> ({{ $product->nego->option }})</small>
              <br>
              <span class="grey-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="8"/>
              </svg>  
              </span>
              <small id="condition">{{ $product->condition->condition }}</small>  
              <br><br>
              <h4 id="desc">Description</h4>
             
              <small>Brand: {{ $product->brand }} </small>
              <br>
              <small>Material: {{ $product->material}}</small>
              <br>
              <small>More Description: {{ $product->more_desc}} </small>
              <br>
              <small>Meetup Point: {{ $product->meetup_point}} </small>
              </div>
            

          </div>

        
          <div class="col-md-6 mt-5">
            <div class="card" style="width: 20rem; height: 15rem; border-radius: 0; margin-left:200px">
             
              <div class="card-body">
                <img  class="profile-picture" src="images/books.png" alt="User Profile Picture">
                <h4 id="user" >{{ $product->user->username }}</h4>
                <div class="box ">
                  <a href="{{ route('buy.show',  ['id' => $product->id]) }}" class="button button1">Buy</a>
                <br><br>
                <a href="{{ route('cart.show',  $product->id) }}" class="button button2 mt-2">Add to Cart</a>
                <br><br>
               
                <a href="{{ route('chat.show', $product->id) }}" class="button button3 mt-2">Chat</a>
                
                </div>
              </div>
            </div>
          </div>
        
           <br>
    
            
                
          
            
            
  
          </div>
    </div>

  </div>

    
    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  
  
  </body>
</html>