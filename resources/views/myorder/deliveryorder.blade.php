<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/footer.css">
  </head>
  <body>

      @include('partials.navbar')

      <!--success messages; later will be replaced with pop up alert/messages-->
      @if(session()->has('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif
   
      <div class="row g-3">
       @include('myorder.profilesbar')

        <div class="col-md-8">
        @include('myorder.mainsidebar')

            @include('myorder.ordertrack')

          <div class="container-under-table">
            <!-- Your container content under the table goes here -->
            <div class="selection-title">
               
            </div>
            
            <div class="products-listing">
              <div class="row g-2" >
                <div container style=" background-color: white;  border: none;min-height: 50vh;display: flex; align-items: center; justify-content: center;">
                  @forelse($order_items->groupBy('order.id') as $orderId => $orderGroup)
                    <div class="col">       
                        <div class="card-body d-flex flex-column">
                        <div class="card  text-center " style="width: 670px; height: auto;">
                            <div class="buyer mt-3" style="display: inline-block; margin-left:15px;">
                                <div style="text-align: left;">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16" style="margin-left: 10px;">
                                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                                  </svg>
                                  @foreach($order_items as $order_item)
                                    <small style="font-weight: bold; font-size:15px;"> {{ $order_item->product->user->username }}</small>
                                  @endforeach
                                </div>
                            </div> 
                            @foreach($orderGroup as $order_item)
                             <div class="order-details mt-3"  style="display: flex; align-items: center; margin-left:15px; " >
                             <div class="img mb-1 ma-auto">
                                @if ($order_item->product->product_pic)
                                @if (is_array(json_decode($order_item->product->product_pic)))
                                <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                                  <div class="carousel-inner">
                                      @foreach(json_decode($order_item->product->product_pic) as $index => $imagePath)
                                          <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                              <img src="{{ asset('storage/' . $imagePath) }}"width="50" height="50"  alt="Image {{ $index + 1 }}">
                                          </div>
                                      @endforeach
                                  </div>
                                </div>
                                @else
                                <img src="{{ asset('storage/' . $order_item->product->product_pic) }}" width="70" height="70">
                                @endif
                               @endif
                            </div>

                            <div class="row ma-auto" style="display: flex; justify-content: left; text-align:left; margin-left:7px;">
                                <small style="font-weight: bold; font-size:15px;">
                                    {{ $order_item->product->product_name }}</small>
                                <small style="font-size:15px;">RM{{ $order_item->product->product_price }}
                                </small>
                            </div>
                            </div>
                            @endforeach
    
                            <div style="text-align: left;">
                                <h6 style="margin-top:10px;margin-left:15px;">Total Order: RM {{ $order_item->order->totalOrder}}</h6>
                            </div>

                          </div>
                        </div>
                        
                      </div>
                      @empty
                         <div class="col">
                             <h6 style="color:grey;text-align:center;align-items:center;">No order</h6>
                         </div>
                       @endforelse
                </div>
                    </div>
                    
                 
               
                  </div>
            
                
      
              </div>
        

            </div>
          </div>
       
        </div>

      </div>
      
      
      
    
      @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>