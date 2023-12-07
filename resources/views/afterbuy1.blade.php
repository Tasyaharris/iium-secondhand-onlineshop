<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="/css/buy.css">

 

  </head>
  <body>

    @include('partials.header')
    
    <div class="box1" >
        <div class="explanation">
        <div class="successful">
        <h6>Transaction Successful. We have informed your order to the seller. </h6>
        </div>
        <br>
        <div class="links">
        <a href="/homepage" style="color:black; text-align: center;">Back to Main Page</a>
        <a href="/homepage" style="color:black; margin-left:310px; text-align: center;">OK</a>
      
        </div>

        </div>
    </div>
 
    @include('partials.footer')

   
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    
</body>
</html> 