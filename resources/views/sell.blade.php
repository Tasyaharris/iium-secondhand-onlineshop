<!doctype html>
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
              <a href="/homepage" class=" p-3 text-secondary text-decoration-none d-inline" style="color: #000">Listing Item</a>
            </div>
        </nav>
        
          <br><br>
        
      <form>
            <!--Image-->
            <div class="inp_img mb-3" >
                <div class="mb-4 mt-5 d-flex justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                      </svg>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="btn_upload">
                    <label class="form-label m-1 " for="customFile1">Select Photos</label>
                    <input type="file" class="form-control d-none" id="customFile1" />
                    </div>
                </div>
                <div class="d-flex mt-2 justify-content-center">
                    <p class="reminder">Please snap the item from different angle</p>
                </div>
            </div>
        
            <select class="form-select mb-3 mt-3" aria-label="Default select example">
                <option selected>Select Category</option>
                <option value="1">Fashion</option>
                <option value="2">Book</option>
                <option value="3">Electronics</option>
                <option value="4">Mahallah Equipment</option>
                <option value="5">Cosmetics</option>
                <option value="6">Others</option>
            </select>

            <div class="form-floating mb-3 mt-3">
                <input type="product_name" class="form-control" id="floatingInput" placeholder="Item Name">
                <label for="floatingInput">Item Name</label>
            </div>
            <div class="abt_product">
                <h5>About the product</h5>
                <br>
                <h6>Condition</h6>
                <p><a href="/cond_details">Please refer to condition details here</a></p>
            </div>
           
            <div class="condition mb-3 mt-3">
                <input type="radio" class="btn-check"  name="options-outlined" id="option5-outlined" autocomplete="on">
                <label class="btn btn-outline-secondary" for="option5-outlined">Brand New</label>

                <input type="radio" class="btn-check" name="options-outlined" id="option6-outlined" autocomplete="off">
                <label class="btn  btn-outline-secondary" for="option6-outlined">Like New</label>

                <input type="radio" class="btn-check"  name="options-outlined" id="option7-outlined" autocomplete="off">
                <label class="btn  btn-outline-secondary" for="option7-outlined">Lightly Used</label>

                <input type="radio" class="btn-check" name="options-outlined" id="option8-outlined" autocomplete="off">
                <label class="btn  btn-outline-secondary" for="option8-outlined">Used</label>

                <input type="radio" class="btn-check"  name="options-outlined" id="option9-outlined" autocomplete="off">
                <label class="btn  btn-outline-secondary" for="option9-outlined">Heavy Used</label>
            </div>

            <div class="pricing mb-3 mt-3">
                <h6>Price</h6>
                <div class="dist_opt">
                <input type="radio" class="btn-check" name="options1-outlined"  id="btn-check-outlined" autocomplete="off">
                <label class="btn btn-outline-secondary" for="btn-check-outlined">For Sale</label>

                <input type="radio" class="btn-check" name="options1-outlined" id="btn-check-2-outlined" autocomplete="off">
                <label class="btn  btn-outline-secondary" for="btn-check-2-outlined">For Free</label>
                </div>

            <div class="inp_price mb-3 mt-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text">RM</span>
                        <input type="text" class="form-control" name="price" id="price" aria-label="Text input with dropdown button">
                        <select class="form-select" name="option_seller" id="inputGroupSelect01">
                            <option selected value="1">Negotiable</option>
                            <option value="2">Non-Negotiable</option>
                          </select>
                    </div>
            </div>

            <div class="row mb-3">
                <label for="inputEmail3" name="brand" class="col-sm-2 col-form-label">Brand</label>
                <div class="col-sm-10">
                  <input type="email" name="brand"  class="form-control" id="inputEmail3">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" name="material" class="col-sm-2 col-form-label">Material</label>
                <div class="col-sm-10">
                  <input type="password"  name="material" class="form-control" id="inputPassword3">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3"  name="description" class="col-sm-2 col-form-label">More Description(Optional)</label>
                <div class="col-sm-10">
                  <input type="password"   name="description" class="form-control" id="inputPassword3">
                </div>
            </div>

            <div class="meetup">
                <h6>Meet-Up Point</h6>
                <div class="col-12">
                    <input type="text" class="form-control" id="inputAddress" placeholder="KICT">
                  </div>
            </div>
            
            <button type="submit" class="btn_items mt-3 mb-3">Submit</button>
        </form>
   

    </div>
    
    
    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>