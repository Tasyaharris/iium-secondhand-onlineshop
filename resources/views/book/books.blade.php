<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="/css/products.css">
    

  </head>
  <body>

    @include('partials.header')
    @include('partials.filtering')
 

    <div class="row g-2" style="border: none; margin-left:80px;">
    
    @foreach ($products as $product)
    <div class="col">
      <div class="card mx-4 mb-3" style="border-radius: 10px;margin-top:50px;width: 210px; height: 290px; ">

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

          </div>
        </a>
      </div>
    </div>
    @endforeach
  </div>

    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>