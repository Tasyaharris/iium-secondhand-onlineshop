<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>

      @include('partials.navbar')
      @include('partials.explore')     
      @include('partials.recommended')
      @include('partials.forfree')
    

      <div class="container mt-2">
       
        @yield('container')

      </div>

      
      @include('partials.footer')
    
      <script>
       const carousel = document.getElementById('myCarousel');
        const leftArrow = document.getElementById('left-arrow');
        const rightArrow = document.getElementById('right-arrow');
        let scrollAmount = 0;

        leftArrow.addEventListener('click', () => {
            if (scrollAmount > 0) {
                scrollAmount -= 1;
                carousel.style.transform = `translateX(-${scrollAmount * 540}px)`; // Adjust the value based on the card width and spacing
            }
        });

        rightArrow.addEventListener('click', () => {
            if (scrollAmount * 4 < {{ count($products) }}) {
                scrollAmount += 1;
                carousel.style.transform = `translateX(-${scrollAmount * 540}px)`; // Adjust the value based on the card width and spacing
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>