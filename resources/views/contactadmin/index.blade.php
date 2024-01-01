<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/community.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
  </head>
  <body class="d-flex flex-column min-vh-100">

    @include('partials.navbar')

       <!--success messages; later will be replaced with pop up alert/messages-->
       @if(session()->has('success'))
       <div class="alert alert-success" role="alert">
         {{ session('success') }}
       </div>
       @endif

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



   <div class="containerc">   
    <div class="row">
      <nav class="col-md-3 side-navbar">
          <div class="table-container">
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

      <div class="detail-desc1" style="width: 900px;" >
      <form action="/contactadmin" method="POST">
        @csrf
      <div class="row" style=" border: 1px solid #000; width:auto;">
          <div class="col-md-8 mb-0 type-title"  >
            <h6>Title: </h6>
            <input class="form-control @error('title') is-invalid @enderror" type="text"  name="title" id="title" maxlength="255" required style="margin-left: 5px; border:none;">
            @error('title')
            <div class="invalid-feedback">
             {{ $message }}
            </div>
            @enderror
          </div>
          
          <div class="col-md-8 mt-0 type-desc" >
              <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" placeholder="Type your message here" required style="margin-top: 7px; border:none; height:180px;"></textarea>
              @error('message')
              <div class="invalid-feedback">
               {{ $message }}
              </div>
             @enderror
          </div>
      </div>          
    </div> 
   </div>

   </div>

   <div class="containerd">
    <a class="submit-discussion" style="text-decoration:none;" href="/submitcontactadmin">
      <button type="submit" class="btn_items" id="submitBtn"  >Submit</button>
    </a>
   </div>

  </form>


    @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>




  </body>
</html>