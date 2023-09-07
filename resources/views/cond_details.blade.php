<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/sell.css">
    
</head>
<body>
    
    @include('partials.header')
    
    <div class="container mt-2">
       
        <nav class="navbar navbar-expand-lg  mb-0">
            <div >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16"> <a href="/homepage">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </a>   
                </svg>
              <a href="/sell" class=" p-3 text-secondary text-decoration-none d-inline" style="color: #000">Listing Item</a>
            </div>
        </nav>
        
          <br><br>

    <div class="explanations">
        <h5>Brand New </h5>
        <p class="brand_new">These products are completely unused and in their original condition. The product will be sell with the original packaging.
            <br>
            Time Used : never
        </p>

        <h5>Like New </h5>
        <p class="like_new">These products are in excellent condition and show minimal signs of wear, if any. They may have been used briefly or only a few times, but they appear almost indistinguishable from brand-new items.
            <br> 
            Time used : less than a month
        </p>

        <h5>Lightly Used </h5>
        <p class="lightly_used">These products have been used, but they remain in good condition with minimal wear and tear. They may show some signs of previous use, such as slight scratches or minor cosmetic flaws, but they are still in overall great shape. 
            <br>
            Time Used: less than six months.
        </p>

        
        <h5>Used </h5>
        <p class="used">These products have been previously owned and used, and they may show noticeable signs of wear and tear. They may have some visible scratches, minor defects, or signs of usage, but they are still functional and usable. 
            <br>
            Time Used: between six months to a year or more.
        </p>

        
        <h5>Heavy Used </h5>
        <p class="heavy_used">These products have been extensively used and may exhibit significant signs of wear and tear. They might have noticeable scratches, dents, or other visible damage. While they are still usable, they may require repairs or maintenance.
            <br>
            Time Used: more than a year
        </p>


    </div>

    </div>
</body>
</html>