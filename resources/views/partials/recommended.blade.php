
<section class="explore border-bottom mt-0" id="explore" style="background-color: #D9D9D9">
    <div class="max-width">
      <div class="explore-content">
        <div class="text-1">
          <p class= "p-3"  style ="font-weight: bold"> RECOMMENDED </p>
        </div>
       
        <div class="row g-2" href="/products.viewproduct">
          @foreach ($products as $product)
          <div class="col">
            <div class="card w-50 mx-4 mb-3">

              <div class="username">
                <h6>{{ $product->user_name }}</h6>
              </div>

              <a class="card-body" href="{{ route('products.show', $product->id) }}">
                <a class="img" href="{{ route('products.show', $product->id) }}">
            
                  @if ($product->product_pic)
                  <img src="{{ asset('storage/' . $product->product_pic) }}" width="70" class="rounded-circle">
                  @endif
                </a>
              
              
              
              
                <div class="prod-desc">
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
      </div>
    </div>
   

    
</section>