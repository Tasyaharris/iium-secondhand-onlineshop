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
    {{-- <link rel="stylesheet" href="/css/main.css"> --}}
  </head>
  <body>

      @include('partials.navbar')

      <!--success messages; later will be replaced with pop up alert/messages-->
      @if(session()->has('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif

      <div id="cancelOrderModal" style="display: none;">
        <!-- Your modal content goes here -->
        <p>Are you sure to cancel this order?</p>
        <button onclick="confirmCancelOrder()">Yes</button>
        <button onclick="closeCancelOrderModal()">No</button>
      </div>
    
   
      <div class="row g-3">
        @include('myorder.profilesbar')

        <div class="col-md-8">
          <nav class="side-navbar">
            <!-- Your sidebar content goes here -->
            <div class="table-container">
            <table class="selection">
              <tr>
                <td class="clickable-row active {{ Request::is('listings') ? 'active' : ' ' }}" onclick="window.location='/profile'">
                  <a href="/profile">My Listings</a>
              </td>
              <td class="clickable-row {{ Request::is('productreview') ? 'active' : ' ' }}" onclick="window.location='/productreview'">
                  <a href="/productreview">Reviews</a>
              </td>
              <td class="clickable-row {{ Request::is('cart') ? 'active' : ' ' }}" onclick="window.location='/cart'">
                  <a href="/cart">My Cart</a>
              </td>
              <td class="clickable-row {{ Request::is('myorder') ? 'active' : ' ' }}" onclick="window.location='/myorder'">
                  <a href="/myorder">My Order</a>
              </td>
              
              
              </tr>
            </table>
            </div>
          </nav>

          <nav class="side-navbar1" style="margin-left:10px;padding:0px; display:inline-block;">
            <div class="order-title" style="display: inline-flex;">

            <!-- Your sidebar content goes here -->
            <div class="table-container1">
            <table class="selection1" >
              <tr>
                <td class="clickable-row  {{ Request::is('listings') ? 'active' : ' ' }}"  data-href="/listings">
                  <a href="/sold">Completed</a>
                </td>
                <td class="clickable-row  {{ Request::is('pending') ? 'active' : ' ' }}"  data-href="/pending">
                  <a href="/pending">Await Confirmation</a>
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
                <h5>Listings</h5>
            </div>
            
            <div class="products-listing">
              <div class="row g-2" style="min-height: 50vh;">
          
                @foreach ($products as $product)
                <div class="col" >
                    <div class="card  text-center mb-3 " style="width: 210px; height: 290px;">
                      <div class="card-body d-flex flex-column">
                        <div class="img text-center mb-1">
                            @if ($product->product_pic)
                            @if (is_array(json_decode($product->product_pic)))
                            <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                              <div class="carousel-inner">
                                  @foreach(json_decode($product->product_pic) as $index => $imagePath)
                                      <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                          <img src="{{ asset('storage/' . $imagePath) }}"width="100" height="100"  alt="Image {{ $index + 1 }}">
                                      </div>
                                  @endforeach
                              </div>
                            </div>
                            @else
                            <img src="{{ asset('storage/' . $product->product_pic) }}" width="100" height="100">
                            @endif
                           @endif
                        </div>
                        
                        <div class="prod-desc mt-1 flex-grow-1">
                        <h6 id="product_name" >{{ $product->product_name }}</h6>
                        <small id="price" id="price" > RM {{ $product->product_price }}</small>
                        <small id="seller_option"> ({{ $product->nego_option }})</small>
                        <br>
                        <small id="condition">{{ $product->condition_name }}</small>    
                       
                        </div>
                      
                        <br>
                        
                        <!--if the product is sold, display status and button -->
                        @if($product->productstatus_id == 1)
                        <h6 style="text-align: left;margin-bottom:40px;color:red">Sold</h6>
                        @else
                        <!--like-->
                   

                        <div class="options">
                           <div class="dropdown ms-auto">
                            <i class="fas fa-ellipsis-vertical" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu">
                              <li>
                                  <!--update item button-->
                                  <span class="dropdown-item">
                                    <a href="{{ route('sell.edit', $product->id) }}" style="color: black; text-decoration:none; font-style: normal;">
                                      <i class="fas fa-pen mx-2 "></i>Update
                                    </a>  
                                  </span>
                              </li>
                              <li>
                                <!--delete item button-->
                              
                                  <form action="{{ route('sell.destroy', $product->id) }}"  method="post">
                                    <span class="dropdown-item">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" onclick="return confirm('Are you sure to delete this item?')" style="border: none; background-color: white;">
                                      <i class="fas fa-trash mx-2"></i> Delete
                                    </button>
                                    </span>
                                  </form>  

                  
                              </li> 
                            </ul>
                        </div>
                        </div>
                            @endif

                      </div> 
                    </div>
                    
                </div>
                    
                @endforeach
              
             
            </div>
          </div>
       
        </div>

      </div>
      
      
      
    
      @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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