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
    
    <!--success messages; later will be replaced with pop up alert/messages-->
    @if(session()->has('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
      {{ session('success') }}
      <button type="button" id="closeBtn" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

    <div class="box1 ">
        <div class="content">
            <div class="logo">
                <img class="mb-2" src="images/logo.png" alt="logo" width="65" height="50">
            </div>
            <div class="text">
                <h5 style="text-align: center; font-weight:bold; margin-top:10px;" >COMMUNITY FORUM</h5>
            </div>
        </div>
    </div>

   <div class="box-title" >
        <div class="disc-box" style="padding:0 ; margin-bottom:0;">
        <div class="disc-title" style="margin-top: 10px; padding: 0;">
            <h6 style="text-align: center; font-size: 22px; ">DISCUSSION</h6>
        </div>
        </div>
   </div>

   
   <div class="container-fluid flex-grow-1 mt-2 mb-4">   
    <div class="row">
      <nav class="col-md-3 side-navbar">
          <div class="table-container"  >
          <table class="selection" style=" margin:0;padding:0;">
            <tr>
              <td class="clickable-row {{ Request::is('discussion') ? 'active' : ' ' }}"  data-href="/discussion">
                <a href="/discussion">Recent</a>
              </td>
              <td class="clickable-row active{{ Request::is('reviews') ? 'active' : ' ' }}" data-href="/yourpost">
                <a href="/yourpost">Your Post</a>
              </td>
            </tr>
          </table>
          </div>
      </nav>

        <div class="col-md-9" style="margin-left:10px;">
            <!-- Content for the second half of the page -->
            @foreach ($discussions->take(5) as $discussion)
            <nav class="navbar bg-body-tertiary mt-0 " style="border:1px solid grey;">
              <div class="row" >
              <div class="discussion-bar"  data-discussion-id="{{ $discussion->id }}" >
                <!--seller profile-->
                  <div class="text-left" style="display: flex; align-items: center;">
                      <div class="col-md-0" style="margin-left: 25px;" >
                          <h6>{{ $discussion->user_name }}</h6>
                      </div>
                      <div class="col-md-8">
                      <div class="row" style="margin-left: 7px;" >
                          <h6>{{ $discussion->title }}</h6>
                          <p>{{ $discussion->discussion }}</p>
                      </div>
                      </div>
                  </div>
              </div>
              
              <div class="comments-container" style="display: none;"  data-discussion-id="{{ $discussion->id }}"> <!-- Initially hide comments -->
                  <livewire:comments :model="$discussion"/>
              </div>
            </div>

            <form action="{{ route('createdisc.destroy', $discussion->id)}}" method="post">
                @method('DELETE')
                @csrf
              <div class="col-md-12 delete d-flex justify-content-end" style="margin-right:15px;">
                <button type="submit" class="bg-body-tertiary" style="border:none; text-decoration:underline;margin-right:15px;" onclick="return confirm('Are you sure to delete this post?')">
                   Delete Post
                </button>
              </div>
            </form>
          </nav>
            @endforeach
              <!-- Create Discussion button -->

              <a href="/createdisc" class="create-discussion ms-auto" style="text-decoration: none;">
                <button type="button" class="btn btn-info no-hover-effect mt-2 ms-auto"  style="padding:0; background-color: #416A77; color: #fff; width: 150px; line-height: 50px; text-align: center; font-weight: bold; display: inline-block;">Create Discussion</button>
              </a>
            
              
        </div>
    </div>
   </div>
    
    
    
    @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
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
  </script>
  </body>
</html>