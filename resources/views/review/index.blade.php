<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/css/review.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/footer.css">
    <title>Review</title>

   
</head>
<body>
    
    @include('partials.header')

    <nav class="navbar navbar-expand-lg " style="height: 50px;">
        <div  style="margin-left:30px;">
            <a href="javascript:history.back();" style="text-decoration: none; color: inherit;">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16" style="margin-bottom: 3px;">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
                </svg>
            </a>
          <a  class=" p-3  text-decoration-none d-inline" style="color: #000">Review Item</a>
        </div>
    </nav>

    
    <div class="order-desc">
        <!--product-details-->
        <form method="post" action="{{ url('review')}}">
        @csrf
        <nav style="height: auto;border: 1px solid #000; ">
            @foreach($order_items->groupBy('order.id') as $orderId => $orderGroup)    
            <!--seller name-->
            <nav style="height: 55px;">
            <div class="seller mt-3" style="display: inline-block; margin-left:15px;">
                <div style="text-align: left;display:flex;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16" style="margin-left: 10px;">
                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                </svg>
                <div style="margin-left:5px;">
                @if($orderGroup->first() && $orderGroup->first()->order && $orderGroup->first()->order->user)
                <h6> {{ $orderGroup->first()->product->user->username }}</h6>
                @else
                <h6></h6>
                 @endif
                </div>
                </div>
            </div> 
            </nav>

            @foreach($orderGroup as $order_item)
            <nav style="height:auto;">
                 <div class="order-details mt-3 mb-3"  style="display: flex; align-items: center; margin-left:15px; " >
                 
                 <input type="hidden" name="order_item[]" value="{{ $order_item->id }}" >
                    <div class="img ma-auto" style="margin-left: 10px;">  
                        @if (is_array(json_decode($order_item->product->product_pic)))
                        @php $firstImagePath = json_decode($order_item->product->product_pic)[0]; @endphp
                                  <div class=" img_recom" style="margin-left: 3px; margin-bottom:0px">
                                      <img src="{{ asset('storage/' . $firstImagePath) }}"width="130" height="130" >
                                  </div>   
                        @endif
                    </div>
                   
                    <div class="row ma-auto" style="display: flex; justify-content: left; text-align:left; margin-left:7px;" >
                        <small style="font-weight: bold; font-size:15px;">
                            {{ $order_item->product->product_name }}</small>
                        <small style="font-size:15px;">RM{{ $order_item->product->product_price }}
                        </small>
                    </div>  
                </div> 
                  <!--rate product quality-->
                <nav class="navbar navbar-expand-lg " style="height: auto;border: 1px solid #000;">
                    <div  style="margin-left:30px;display:flex;align-items:center;">
                      <a  class=" p-3  text-decoration-none d-inline" style="color: #000">Product Quality</a>
                      <div class="rating-css" style="margin-left: 380px; margin-right: 30px;">
                        <div class="star-icon"  style="display: flex;">
                            <input type="radio" value="1" name="product_rating[{{ $order_item->id }}]" checked id="rating1_{{ $order_item->id }}">
                            <label for="rating1_{{ $order_item->id }}"><i class="fas fa-star"></i></label>
                            <input type="radio" value="2" name="product_rating[{{ $order_item->id }}]" id="rating2_{{ $order_item->id }}">
                            <label for="rating2_{{ $order_item->id }}"><i class="fas fa-star "></i></label>
                            <input type="radio" value="3" name="product_rating[{{ $order_item->id }}]" id="rating3_{{ $order_item->id }}">
                            <label for="rating3_{{ $order_item->id }}"><i class="fas fa-star "></i></label>
                            <input type="radio" value="4" name="product_rating[{{ $order_item->id }}]" id="rating4_{{ $order_item->id }}">
                            <label for="rating4_{{ $order_item->id }}"><i class="fas fa-star "></i></label>
                            <input type="radio" value="5" name="product_rating[{{ $order_item->id }}]" id="rating5_{{ $order_item->id }}">
                            <label for="rating5_{{ $order_item->id }}"><i class="fas fa-star "></i></label>
                        </div>
                    </div>
                    </div>
                </nav>

                 <!--comment-->
                <nav class="navbar navbar-expand-lg " style="height: auto;border: 1px solid #000;">
                    <div  style="margin-left:30px;display:flex;align-items:center;">
                      <a  class=" p-3  text-decoration-none d-inline" style="color: #000">Comment:</a>
                      <textarea class="form-control mt-3" id="comment"  name="comment[{{ $order_item->id }}]" placeholder="Type comment here" style="height: 50px;border:none;margin-left:7px;width:1100px;text-transform:uppercase"></textarea>
                    </div>
                </nav>
            </nav>
            @endforeach 
            @endforeach
        </nav>

      <!--seller services-->
      <nav class="navbar navbar-expand-lg " style="height: auto;">
        <div  style="margin-left:30px;display:flex;align-items:center;">
            <a  class=" p-3  text-decoration-none d-inline" style="color: #000">Seller Services</a>
            <div class="seller-css" style="margin-left: 380px; margin-right: 30px;">
              <div class="sellerstar-icon"  style="display: flex;">
                  <input type="radio" value="1" name="seller_rating" checked id="rating6">
                  <label for="rating6"><i class="fas fa-star "></i></label>
                  <input type="radio" value="2" name="seller_rating" id="rating7">
                  <label for="rating7"><i class="fas fa-star "></i></label>
                  <input type="radio" value="3" name="seller_rating" id="rating8">
                  <label for="rating8"><i class="fas fa-star "></i></label>
                  <input type="radio" value="4" name="seller_rating" id="rating9">
                  <label for="rating9"><i class="fas fa-star "></i></label>
                  <input type="radio" value="5" name="seller_rating" id="rating10">
                  <label for="rating10"><i class="fas fa-star "></i></label>
              </div>
          </div>
          </div>
        </nav>
   
    <!--submit button-->
    <nav class="navbar navbar-expand-lg " style="height: 60px;border: 1px solid #000;">
        <div class="col d-flex mt-3" style="margin-right: 15px;">
        <button type="submit" class="processBtn ms-auto" style="margin-right: 15px;border-radius: 5px; border: 1px solid #000; background: rgba(168, 184, 208, 0.80); text-align: center; text-decoration: none; color: black; height: 30px; width: 80px; margin-right: 15px; margin-bottom: 10px; display: flex; align-items: center; justify-content: center;">Review</a>
        </div>
    </nav>

    </form>
    </div>   

    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>