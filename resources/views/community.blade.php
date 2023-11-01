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

    <div class="containerc" style="justify-content: center; ">
        <div class="left " style="width: 30%;">
            <div class="com-pic">
                <a class="logo1" href="/discussion">
                <img class="mb-2" src="images/discussion.png" alt="logo" width="90" height="90" style=" display: flex;justify-content: center; margin-top: 40px;">
                </a>
                <div class="title2">
                    <h6 style="text-align: center; font-weight:bold; margin-top:10px;" >DISCUSSION</h6>
                </div>
            </div>
        </div>
        <div class="right" style="width: 30%;">
            <div class="com-pic">
                <a class="logo1" href="/feedback">
                <img class="mb-2" src="images/feedback.png" alt="logo" width="80" height="80"  style=" display: flex;justify-content: center; margin-top: 40px;">
                </a>
                <div class="title2">
                <h6 style="text-align: center; font-weight:bold; margin-top:10px;" >FEEDBACK AND SUGGESTION</h6>
                </div>
            </div>
                     
        </div>
    </div>
    
    
    
    
    @include('partials.footer')
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>