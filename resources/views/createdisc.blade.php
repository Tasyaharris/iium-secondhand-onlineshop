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

    <div class="detail-desc1" style="width: 900px;" >
      <form action="/createdisc" method="post" id="myForm">
        @csrf
      <div class="row" style="margin-left:7px; border: 1px solid #000;">
          <div class="col-md-8 mb-0 type-title"  >
            <h6>Title: </h6>
            <input class="form-control @error('title') is-invalid @enderror" type="text"  name="title" id="title" maxlength="255" required style="margin-left: 5px; border:none;">
            @error('title')
            <div class="invalid-feedback">
             {{ $message }}
            </div>
            @enderror
          </div>
          <div class="col-md-8 mb-0 type-title"  >
            <h6>Title: </h6>
            <input class="form-control @error('slug') is-invalid @enderror" type="text"  name="slug" id="slug" maxlength="255" required style="margin-left: 5px; border:none;">
            @error('slug')
            <div class="invalid-feedback">
             {{ $message }}
            </div>
            @enderror
          </div>
          <div class="col-md-8 mt-0 type-desc" >
              <textarea class="form-control @error('discussion') is-invalid @enderror" id="discussion" name="discussion" placeholder="Type discussion here" required style="margin-top: 7px; border:none; height:180px;"></textarea>
              @error('discussion')
              <div class="invalid-feedback">
               {{ $message }}
              </div>
             @enderror
          </div>
      </div>          
    </div> 
   </div>

   <div class="containerd">
    <a class="submit-discussion" style="text-decoration:none;" href="/submitdisc">
      <button type="submit" class="btn_items" id="submitBtn" >Submit</button>
    </a>
   </div>

  </form>


    @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>
   
    </script>

  </body>
</html>