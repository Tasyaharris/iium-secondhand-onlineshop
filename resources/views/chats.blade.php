<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <div id="chat-list" class="chat-list mt-5">
                  <!-- user lists -->
                  @foreach($friends as $friend)
                      <div class="friends mt-1" data-id="{{ $friend->id }}" data-name="{{ $friend->username }}" >
                         
                          <div class="friends-credent ">
                              <!-- name -->
                              <span class="friends-name">{{ $friend->username }}</span>
                              <!-- last message -->
                              <span class="friends-message friend-status">Offline</span>
                          </div>
                      </div>
                  @endforeach
              </div>
               
              </div>
              

        </div>
       
        <div class="col-md-6">
          <!-- Content for the second half of the page -->
          <section id="main-empty" class="main-right">
            <p style="text-align: center; ">Welcome to Chat</p>
        </section>
        <section id="main-right" class="main-right hidden">
            <!-- header -->
            <div id="header-right" class="header-right">
                <!-- profile pict -->
                <div id="header-img" class="profile header-img">
                   
                </div>
    
                <!-- name -->
                <h4 class="name friend-name">Mario Gomez</h4>
            </div>
    
            <div class="container room-chat d-flex justify-content-center align-items-center mb-0" style="height: 290px ;">
                <h6 class="p-3 text-decoration-none d-inline" ></h6>
              </div>

            <!-- chat area -->
            <div id="chat-area" class="chat-area">
                <!-- chat content -->
    
            </div>
    
                  <!-- typing area -->
         <div class="typing-area mb-2" id="typing-area">
            <input id="type-area" class="type-area" placeholder="Type a message..." style="width: 500px;">
            <button class="btn_items " id="send-button">Send</button>

          </div>
        </section>
        </div>
      </div>

     
    @include('partials.footer')

    {{-- url --}}
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
 
    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
 

  </body>
</html>