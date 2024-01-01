<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/community.css">
 </head>
  <body  class="d-flex flex-column min-vh-100">

    @include('partials.navbar')
 

   <div class="box1 w-100 m-auto">
    <div class="content">
        <div class="logo">
            <img class="mb-2" src="images/logo.png" alt="logo" width="65" height="50">
        </div>
        <div class="text">
            <h5 style="text-align: center; font-weight:bold; margin-top:10px;" >CONTACT ADMIN</h5>
        </div>
    </div>
    </div>


   
   <div class="container-fluid flex-grow-1 mt-2 mb-4">   
    <div class="row">
      <nav class="col-md-3 side-navbar">
          <div class="table-container"  >
          <table class="selection" style=" margin:0;padding:0;">
            <tr>
              <td class="clickable-row  {{ Request::is('contactadmin') ? 'active' : ' ' }}"  data-href="/contactadmin">
                <a href="/contactadmin">Post Message</a>
              </td>
              <td class="clickable-row {{ Request::is('yourpost') ? 'active' : ' ' }}" data-href="/yourpost">
                <a href="/yourpost">Admin Response</a>
              </td>
            </tr>
          </table>
          </div>
      </nav>

        <div class="col-md-9" style="margin-left:10px;">
            <!-- Content for the second half of the page -->
            <div class="discussion-container" style="max-height: 500px; overflow-y: auto;">
            @foreach ($messages->take(5) as $message)
            <nav class="navbar bg-body-tertiary mt-3 " style="border:1px solid grey;border-radius:10px;width:auto;">
              <div class="row" >
              <div class="discussion-bar" >
                <!--seller profile-->
                  <div class="text-left" style="display: flex; align-items: center;">
                      <div class="col-md-18 d-flex" style="align-items: center;">
                      <div class="row" style="margin-left: 7px;" >
                          <h6>{{ $message->title }}</h6>
                          <p>{{ $message->message }}</p>
                      </div>
                      </div>
                     
                  </div> 
              </div>

            
              @forelse ($message->responses as $response)
              <div role="alert" style="margin-left:20px;">
                  <h6 style="font-weight: bold; margin-right:7px;">{{ $response->user->username }}:</h6>
                  <p>{{ $response->body }}</p>
              </div>
              @empty
                  <div role="alert" style="margin-left:20px;">
                      <p style="font-weight: bold;">No responses from admin yet.</p>
                  </div>
              @endforelse
          
              
        
            </div>
          </nav>
            @endforeach
            </div>
           
            
              
        </div>
    </div>
   </div>
    
    
    
    @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    {{-- <script>
      // JavaScript to toggle comments visibility
      document.addEventListener('DOMContentLoaded', function () {
          var discussionBars = document.querySelectorAll('.discussion-bar');
  
          discussionBars.forEach(function (discussionBar) {
              discussionBar.addEventListener('click', function () {
                  var commentsContainer = this.nextElementSibling;
  
                  if (commentsContainer.style.display === 'none') {
                      commentsContainer.style.display = 'block';
                  } else {
                      commentsContainer.style.display = 'none';
                  }
              });
          });
      });
  </script> --}}
  </body>
</html>