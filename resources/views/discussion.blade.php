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
  <body>

    @include('partials.navbar')
    
    <div class="box1 w-100 m-auto">
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


   <div class="containerc">   
    <div class="detailed-box " style=" display: flex; flex-direction: column; margin-right:500px; margin-top:0;padding:0 ; margin-bottom:0;">
        <div class="disc-navbar" style=" margin:0;padding:0;">
        <nav class="side-navbar">
            <div class="table-container"  >
            <table class="selection" style=" margin:0;padding:0;">
              <tr>
                <td class="clickable-row active {{ Request::is('listings') ? 'active' : ' ' }}"  data-href="/listings">
                  <a href="/recent">Recent</a>
                </td>
                <td class="clickable-row {{ Request::is('reviews') ? 'active' : ' ' }}" data-href="/reviews">
                  <a href="/unsolved">Unsolved</a>
                </td>
                <td class="clickable-row {{ Request::is('cart') ? 'active' : ' ' }}" data-href="/cart">
                  <a href="/solved">Solved</a>
                </td>
                <td class="clickable-row {{ Request::is('order') ? 'active' : ' ' }}" data-href="/order">
                  <a href="/pinned">Pinned</a>
                </td>
              </tr>
            </table>
            </div>
        </nav>
        </div>

        <div class="detail-desc" style="width: 710px;" >
            <!-- Content for the second half of the page -->
            @foreach ($discussions->take(4) as $discussion)
            <nav class="navbar bg-body-tertiary mt-0 " style="border:1px solid grey;">
              <div class="discussion-bar">
                  <!--seller profile--> 
                  <div class="text-left" style="display: flex; align-items: center;">
                    <div class="col text-center" style="margin-left: 10px;">
                          <h6>{{ $discussion->user_name }}</h6>
                    </div>
                    <div class="row" style="margin-left:7px;">
                          <h6>{{ $discussion->title }}</h6>
                          <p>{{ $discussion->discussion }}</p>
                    </div>
                    
                  </div>
              </div>
            </nav>
            @endforeach
          </div>
    </div>
        
    <a class="create-discussion" style="width:auto; padding:0; text-decoration:none;" href="/createdisc">
      <button type="button" class="btn btn-info no-hover-effect">Create Discussion</button>
    </a>

   </div>
    
    
    
    @include('partials.footer')
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>