
<section class="explore border-bottom mt-0" id="explore" style="background-color: #D9D9D9; height: 400px;">
  <div class="max-width">
    <div class="explore-content">
      <div class="text-1">
        <p class= "p-3"  style ="font-weight: bold"> RECOMMENDED </p>
      </div>
      <div id="carouselExampleFade" class="carousel slide" style="height: 350px;">
        <div class="carousel-inner">
            @foreach ($products->chunk(5) as $chunk)
                <div class="carousel-item{{ $loop->first ? ' active' : '' }}">
                    <div class="carousel" href="/products.viewproduct" id="myCarousel">
                        @foreach ($chunk as $product)
                            <div class="col">
                                <div class="card mx-4 mb-3" style="width: 200px; height: 310px; flex: 0 0; ">
                                    <!-- Product details -->
                                    <a class="card-body" href="{{ route('products.show', $product->id) }}">
                                    <div class="username mb-0">
                                        <h6>{{ $product->user_name }}</h6>
                                    </div>
                                    
                                    
                                        <a class="img text-center mt-0 mb-4" href="{{ route('products.show', $product->id) }}">
                                            @if ($product->product_pic)
                                                <img src="{{ asset('storage/' . $product->product_pic) }}" width="70" height="90">
                                            @endif
                                        </a>
    
                                        <div class="prod-desc">
                                            <h6 id="product_name">{{ $product->product_name }}</h6>
                                            <small id="price" id="price"> RM {{ $product->product_price }}</small>
                                            <small id="seller_option"> ({{ $product->nego_option }})</small>
                                            <br>
                                            <small id="condition">{{ $product->condition_name }}</small>
                                            <br>
                                            
                                            <svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16" style="margin-left: 4px">
                                              <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                            </svg>
                                            
                                        </div>
                                      
                                       
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
          </svg>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
          </svg>
        </button>
    </div>
    


     
    </div>
   
    
  </div>
  </div>


 
</section>

