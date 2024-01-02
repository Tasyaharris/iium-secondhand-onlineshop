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

      @if(session()->has('success'))
      <div class="alert alert-success d-flex align-items-center" role="alert">
        {{ session('success') }}
        <button type="button" id="closeBtn" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
      </div>
      @endif

      <!-- Modal -->
      <div id="cancelOrderModal" style="display: none;">
        <!-- Your modal content goes here -->
        <p>Are you sure to cancel this order?</p>
        <button onclick="confirmCancelOrder()">Yes</button>
        <button onclick="closeCancelOrderModal()">No</button>
    </div>


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
                <td class="clickable-row  {{ Request::is('profile') ? 'active' : ' ' }}"  data-href="/listings">
                  <a href="/profile">My Listings</a>
                </td>
                <td class="clickable-row {{ Request::is('reviews') ? 'active' : ' ' }}" data-href="/productreview">
                  <a href="/productreview">Reviews</a>
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

          @include('myorder.ordertrack')

          <div class="container-under-table">
            <!-- Your container content under the table goes here -->
            <div class="selection-title">
               
            </div>
            
            <div class="products-listing">
              <div class="row g-2" style="min-height: 50vh;" >
          
                  <div container style=" background-color: white;  border: none;">
                    @forelse($order_items->groupBy('order.id') as $orderId => $orderGroup)
                      <div class="col">       
                          <div class="card-body d-flex flex-column">
                          <div class="card  text-center mt-1 " style="width: 670px; height: auto;">
                              <div class="buyer mt-3" style="display: flex; flex-direction:column; margin-left:15px;">
                                  <div style="text-align: left;display:flex;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16" style="margin-left: 10px;">
                                      <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                                  </svg>
                                  <div style="margin-left:5px;">
                                  @if($orderGroup->first() && $orderGroup->first()->order && $orderGroup->first()->order->user)
                                  <h6> {{ $orderGroup->first()->product->user->username }}</h6>
                                  @else
                                   @endif
                                  </div>
                                  </div>
                              </div> 
                              <div style="text-align:left;margin-left:15px;">
                                <small style="font-weight: bold; font-size:15px; text-align:left;">Order ID: {{ $orderId}}</small>  
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
                                @else
                                  <h6 style="text-align: center; margin-top: 10px; margin-left: 15px; margin-right: 5px;">Pickup point:</h6>
                                  {{ $order_item->product->meetup_point }}
                                @endif
                                </div>
                              </div>
      

                              <div class="processBtn ms-auto" style="margin-top:10px; margin-bottom:20px;display:flex; ">
                                <form action="{{ route('buy.destroy', $order_item->order->id) }}" method="post">
                                  @method('DELETE')
                                  @csrf
                                  <button type="submit" onclick="return confirm('Are you sure to cancel this order?')" style="margin-right:15px;border-radius: 5px; border: 1px solid #000;background: rgba(168, 184, 208, 0.80);  width:120px; display:flex; text-align:center; justify-content:center;text-decoration: none; color:black; height:30px;">
                                      Cancel order
                                  </button>
                                </form>
                              </div>

                                   {{-- <div class="processBtn ms-auto" style="margin-top:10px; margin-bottom:20px;display:flex; ">
                                    <form id="cancelOrderForm" action="{{ route('buy.destroy', $order_item->order->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" onclick="openCancelOrderModal()" style="margin-right:15px;border-radius: 5px; border: 1px solid #000;background: rgba(168, 184, 208, 0.80);  width:120px; display:flex; text-align:center; justify-content:center;text-decoration: none; color:black; height:30px;">
                                            Cancel order
                                        </button>
                                    </form>
                                </div> --}}
                          </div>
                          </div>
                         
                      </div>
                      
                      @empty
                      <div class="col  d-flex align-items-center justify-content-center">
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
      
      
      
    
      @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
    function openCancelOrderModal() {
        document.getElementById('cancelOrderModal').style.display = 'block';
    }

    function closeCancelOrderModal() {
        document.getElementById('cancelOrderModal').style.display = 'none';
    }

    function confirmCancelOrder() {
        // You can perform additional actions here before submitting the form
        document.getElementById('cancelOrderForm').submit();
    }
</script>
    
  </body>
</html>