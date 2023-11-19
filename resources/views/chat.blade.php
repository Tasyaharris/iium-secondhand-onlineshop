<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/chat.css">
    

  </head>
  <body>

    @include('partials.navbar')

      <div class="row g-3 no-gutters" >
        <div class="col-md-6 mb-0 border-right">
          <!-- Content for the first half of the page -->
              <nav class="navbar bg-body-tertiary mt-0 " >
                <div class="container contact-chat" style="border:1px solid grey;">
                  <a href="/homepage" class=" p-3 text-decoration-none d-inline" style="font-weight: bold; color:black;">Chat</a>
                </div>
              </nav>
              <div class="container list-contact d-flex justify-content-center align-items-center mb-0" style="height: 290px ;">
                <h6 class="p-3 text-decoration-none d-inline" style="color: grey;">No Chat</h6>
              </div>
              

        </div>
       
        <div class="col-md-6">
          <!-- Content for the second half of the page -->
          <nav class="navbar bg-body-tertiary mt-0 " style="border:1px solid grey; height:50px;">
            <div class="seller">
             <!--seller profile--> 
              <div class="text-center" style="margin-left: 10px;">
                <p> {{ $product->user->username }}</p>
              </div>
            </div>
          </nav>

          <nav class="navbar bg-body-tertiary mt-0 " style="border:1px solid grey; background: #D9D9D9">
            <div class="product" style="display: flex; align-items: center;">
             <!--product details--> 
             <div class="col text-center" style="margin-left: 10px;">  
              @if (is_array(json_decode($product->product_pic)))
              @php $firstImagePath = json_decode($product->product_pic)[0]; @endphp
                  <div class=" img_recom" style="margin-left: 3px; margin-bottom:0px">
                      <img src="{{ asset('storage/' . $firstImagePath) }}"width="90" height="90" >
                  </div>
              @endif
              </div>
              
              
              <div class="row" style="margin-left:7px;">
                <div class="col-md-8 mb-0"  >
                    <p>{{ $product->product_name }}</p>
                </div>
                <div class="col-md-8 mt-0" >
                    <small>RM {{ $product->product_price }}</small>
                    @if ($product->nego_id != 2)
                    <button class="btn_items1" id="send-button">Negotiate</button>
                    @endif
                </div>
              </div>
              
            </div>
           
            
          </nav>
          
          <div class="container room-chat d-flex justify-content-center align-items-center mb-0" style="height: 290px ;">
            <h6 class="p-3 text-decoration-none d-inline" ></h6>
          </div>



          <!--typing message-->
          <div class="typing-col mt-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16" >
            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
          </svg>
          <div class="typing-message-bar">
            <input type="text" id="message-input" placeholder="Type a message..." style="width: 500px;">
            <button class="btn_items " id="send-button">Send</button>
          </div>


        </div>
        </div>
      </div>
    
    
    
    <br>
    
  



    
    @include('partials.footer')
  </body>
</html>