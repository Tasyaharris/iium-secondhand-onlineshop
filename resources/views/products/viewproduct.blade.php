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

       <!--success messages; later will be replaced with pop up alert/messages-->
       @if(session()->has('success'))
       <div class="alert alert-success d-flex align-items-center" role="alert">
         {{ session('success') }}
         <button type="button" id="closeBtn" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
         </button>
       </div>
       @endif

      <!--error messages-->
      @if(session()->has('error'))
      <div class="alert alert-danger d-flex align-items-center" role="alert">
        <div>
            {{ session('error') }}
        </div>
        <button type="button" id="closeBtn" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
     @endif

  

        <div class="filter_text" style="margin-left:30px;display:flex;">
            <!-- THE FILTERING TEXT-->
            <a href="javascript:history.back();" style="text-decoration: none; color: black; ">
              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16" style="text-decoration: none; color: black; margin-left:10px; margin-top:20px;">
                  <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
              </svg>
            </a>
            <h5 id="category_id" style="margin-top:23px;">{{ $product->category->name}} </h5>
           
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
                <a href="{{ route('sellerprofile.show',  ['id' => $product->user->id]) }}" style="color:black; text-decoration:none;">
                  <h4 id="user" style="font-style: none;" >{{ $product->user->username }}</h4>
                </a>
                
                <div class="box ">
                  @if($product->user->is(auth()->user()))
                  {{-- <a href="{{ route('chat.show',   $product->id) }}" class="button button0">View Chat</a>
                  <br><br> --}}

                  <div class="edit" style="margin-left: 5px; margin-top:40px;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  <a href="{{ route('sell.edit', $product->id) }}" style="text-decoration: none;color:black;" class="mt-3">Edit Listing</a>
                  </div>

                  <br>
                   <form action="{{ route('sell.destroy', $product->id) }}"  method="post">
                      <span class="dropdown-item">
                      @method('DELETE')
                      @csrf
                      <button type="submit" onclick="return confirm('Are you sure to delete this item?')" style="border: none; background-color: white;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                          <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                       <a href="" style="text-decoration: none; color:black;">Delete</a>
                      </button>
                      </span>
                   </form>

                  @else    
                  <a href="{{ route('buy.show', $product->id) }}" class="button button1">Buy</a>
                  <br><br>
                  <form method="post" action="{{ url('cart', $product->id) }}">
                  @csrf
                  <input type="hidden" name="id" id="product_id" value="{{ $product->id }}">
                  <button type="submit" class="button button2 mt-2">Add to Cart</button>
                  </form>
                  <br>

                  {{-- <a href="{{ route('chat.show', $product->id) }}" class="button button3 mt-2">Chat</a> --}}
                  <a href="https://wa.me/{{ $product->user->phone_number }}" target="_blank" rel="noopener noreferrer" class="button button3 mt-2 mb-3">Contact Seller</a>
                  @endif
                  
                
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