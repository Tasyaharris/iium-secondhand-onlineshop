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
        <div class="col-md-4">
          <div class="user-profile">
            <div class="user-info">
              @foreach ($profiles as $profile)
              <div class="flex-container">
                <img  class="profile-picture" src="images/books.png" alt="User Profile Picture">
                <div class="uname">
                  <div class="nameuser">
                    <h6 >{{ $profile->first_name }} </h6>
                    <h6>{{ $profile->last_name }}</h6>
                  </div>
                 
                  <p>{{ auth()->user()->username }}</p>
                </div>
              </div>
              <br>
                <div class="location">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                </svg> 
                <p>{{ $profile->mahallah }}</p>
                </div>
              @endforeach
            </div>
          </div>
          
        </div>

        <div class="col-md-8">
          <nav class="side-navbar">
            <!-- Your sidebar content goes here -->
            <div class="table-container">
            <table class="selection">
              <tr>
                <td class="clickable-row  active{{ Request::is('listings') ? 'active' : ' ' }}"  data-href="/listings">
                  <a href="/profile">My Listings</a>
                </td>
                <td class="clickable-row {{ Request::is('reviews') ? 'active' : ' ' }}" data-href="/reviews">
                  <a href="/reviews">Reviews</a>
                </td>
                <td class="clickable-row {{ Request::is('cart') ? 'active' : ' ' }}" data-href="/cart">
                  <a href="/cart">My Cart</a>
                </td>
                <td class="clickable-row {{ Request::is('myorder') ? 'active' : ' ' }}" data-href="/myorder">
                  <a href="/myorder">My Order</a>
                </td>
              </tr>
            </table>
            </div>
          </nav>

          <nav class="side-navbar1" style="margin-left:10px;padding:0px; display:inline-block;">
            <div class="order-title" style="display: inline-flex;">
            <h5 style="margin-top:10px; text-align:center; margin-left: 45px; ">My Listings</h5>
            <!-- Your sidebar content goes here -->
            <div class="table-container1" style="margin-left:40px;">
            <table class="selection1" >
              <tr>
                <td class="clickable-row  {{ Request::is('listings') ? 'active' : ' ' }}"  data-href="/listings">
                  <a href="/sold">Sold</a>
                </td>
                <td class="clickable-row {{ Request::is('cancelled') ? 'active' : ' ' }}" data-href="/cancelled">
                  <a href="/cancelled">Cancelled</a>
                </td>
                <td class="clickable-row {{ Request::is('orders') ? 'active' : ' ' }}" data-href="/orders">
                  <a href="/orders">Process Order</a>
                </td>
              
              </tr>
            </table>
            </div>
          </div>
          </nav>

          <div class="container-under-table">
            <!-- Your container content under the table goes here -->
            <div class="selection-title">
                <h5>Orders</h5>
            </div>
            
            <div class="products-listing">
              <div class="row g-2" >
            @foreach($order_items->groupBy('order.id') as $orderId => $orderGroup)
                <div class="col">       
                    <div class="card-body d-flex flex-column">
                    <div class="card  text-center mt-1 " style="width: 670px; height: auto;">
                        <div class="buyer mt-3" style="display: inline-block; margin-left:15px;">
                            <div style="text-align: left;">
                            @if($orderGroup->first() && $orderGroup->first()->order && $orderGroup->first()->order->user)
                                <h6>Buyer: {{ $orderGroup->first()->order->user->username }}</h6>
                            @else
                                <h6>Buyer: N/A</h6>
                            @endif
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
                            <img src="{{ asset('storage/' . $order_item->product->product_pic) }}" width="50" height="50">
                            @endif
                           @endif
                        </div>
                        
                        <div class="col" style="display: flex; align-items:center; margin-left:10px;">
                            <small style="flex-basis: 60%; width: 250px; margin-left:5px;margin-right: 30px; font-weight: bold; font-size:15px;">
                                {{ $order_item->product->product_name }}</small>
                            <small style="flex-basis: 60%; margin-right: 30px;font-size:15px;">RM{{ $order_item->product->product_price }}
                            </small>
                        </div>
                        </div>
                        @endforeach

                        <div style="text-align: left;">
                            <h6 style="margin-top:10px;margin-left:15px;">Total Order: RM {{ $order_item->order->totalOrder}}</h6>
                        </div>

                        <div style="text-align: left; display: flex; flex-direction: column; align-items: flex-start;">
                          <div style="text-align: left; display:flex;align-items:center;">
                            <h6 style="margin-top:10px;margin-left:15px;margin-right:5px;">Payment Method:</h6>  {{ $order_item->order->payment->payment_opt}}
                          </div> 
                          <div style="text-align: left; display:flex;align-items:center;">
                            @if ($order_item->order->payment->id == 2)
                                <h6 style="text-align: center; margin-top: 10px; margin-left: 15px; margin-right: 5px;">Payment Proof:</h6>
                                <div>
                                    <a href="{{ asset('storage/' . $order_item->order->paymentProof) }}" download style="color: black;">{{ pathinfo($order_item->order->paymentProof)['basename']}}</a>
                                </div>
                            @endif
                          </div>
                        </div>

                        <div style="text-align: left; display: flex; flex-direction: column; align-items: flex-start;">
                          <div style="text-align: left; display: flex;align-items:center">
                          <h6 style="margin-top: 10px; margin-left: 15px; margin-right: 5px;">Delivery Option:</h6>  {{ $order_item->order->delivery->del_option }}
                          </div>
                          <div style="text-align: left; display: flex;align-items:center">
                          @if ($order_item->order->delivery->id == 1)
                              <h6 style="text-align: center; margin-top: 10px; margin-left: 15px; margin-right: 5px;">Deliver to:</h6>
                              {{ $order_item->order->del_place }}
                          @endif
                          </div>
                        </div>
                      

                  
                        <div class="processBtn" style="margin-left:15px; margin-top:10px; margin-bottom:20px;display:flex;">
                            <a href="{{ url('prepare', $order_item->order->id) }}"  style="border-radius: 5px; border: 1px solid #000;background: rgba(168, 184, 208, 0.80);  width:130px; display:flex; text-align:center; justify-content:center;text-decoration: none; color:black; height:30px;">Process Delivery</a>
                            <form action="{{ route('buy.destroy', $order_item->order->id) }}" method="post">
                              @method('DELETE')
                              @csrf
                              <button type="submit" onclick="return confirm('Are you sure to cancel this order?')"  style="margin-left:30px; color:black;border:none;background-color:white;text-decoration:underline;">
                                  Cancel order
                              </button>
                            </form>
                            </div>
                        </div> 
                        
                        
                    </div>
                   
                </div>
                
             @endforeach
           
              </div>
        

            </div>
          </div>
       
        </div>

      </div>
      
      @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
   
  </body>
</html>