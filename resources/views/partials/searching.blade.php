
<section class="searching border-bottom mt-0" id="searching" style="background-color: white; ">
    <div class="max-width">
      <div class="searching-content">
        <div class="text-1">
          <p class= "p-3"  style ="font-weight: bold; font-size:20px"> Search Result for " {{ $search }} "</p>
        </div>

        <div class="card-container" style="display: flex;  flex-wrap: wrap;justify-content: space-between; ">
        @foreach ($products as $product)
        <div class="col">
          <div class="custom-card mx-4 mb-3" style="border-radius: 10px;margin-top:10px;width: 210px;height: 250px; box-sizing: border-box;   border: 1px solid #D9D9D9; ">
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

    </div>
    
    
    
           
      </div>
     
      
    </div>
    
  
  
   
  </section>
  
  