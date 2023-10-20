<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
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
        
      <form method="post" action="/sell" enctype="multipart/form-data">
        @csrf
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
                    
                    <label class="form-label m-1 " for="customFile1">
                        Select Photos
                    </label>

                    <input type="file" class="form-control @error('image') is-invalid @enderror d-none" id="customFile1" name="image" required onchange="displaySelectedImage(this)" />
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>
                <div class="d-flex mt-2 justify-content-center">
                    <p class="reminder">Please snap the item from different angle</p>
                </div>

                <div class="img">
                    
                    <!--to display the selected image -->
                    <div class="d-flex justify-content-center">
                    <img id="selectedImage" src="#" alt="Selected Image" style="max-width: 100%; max-height: 300px; display: none;">
                    </div>
                  
                    
                </div>
           
                
                  
                
            </div>
    
            <label for="category_id">Product Category</label>
            <select class="form-select mb-3 mt-3" aria-label="Default select example" name="category_id" id="category_id" required  >
                <option selected>Select Category</option>
                @foreach( $categories as $category)
                    @if(old('category_id') == $category->id)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>


            <div class="form-floating mb-3 mt-3">
                
                <input type="product_name" name="product_name" class="form-control @error('product_name') is-invalid @enderror" id="product_name" placeholder="Item Name" required  value="{{ old("product_name") }}" maxlength="255">
                @error('product_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <label for="product_name">Item Name</label>
            </div>
            <div class="abt_product">
                <h5>About the product</h5>
                <br>
                <h6>Condition</h6>
                <p><a href="/cond_details">Please refer to condition details here</a></p>
            </div>
           
           

            <select class="form-select mb-3 mt-3" aria-label="Default select example" name="condition_id" id="condition_id" required  >
                <option selected>Select Condition</option>
                
                @foreach( $conditions as $condition)
                
                    @if(old('condition_id') == $condition->id)
                        <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
                    @else
                        <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
                    @endif
                @endforeach
                
             
            </select>

            <div class="pricing mb-3 mt-3">
                <h6>Price</h6>
                <select class="form-select mb-3 mt-3" aria-label="Default select example" name="option_id" id="option_id" required  >
                    
                    @foreach($selleroptions as $selleroption)
                        @if(old('selleroption_id') == $selleroption->id)
                            <option value="{{ $selleroption->id }}" selected>{{$selleroption->name }}</option>
                        @else
                            <option value="{{ $selleroption->id }}" selected>{{$selleroption->name }}</option>
                        @endif
                    @endforeach
                </select>
                <label for="option">Seller Option</label>       
            </div>

            <div class="inp_price mb-3 mt-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text">RM</span>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="product_price" id="product_price" aria-label="Text input with dropdown button" required value="{{ old("product_price") }}">
                        @error('product_price')
                            <div class="invalid-feedback">
                             {{ $message }}
                            </div>
                         @enderror

                        <select class="form-select" name="nego_id" id="inputGroupSelect01" required value="{{ old("nego_id") }}">
                            @foreach($negos as $nego)
                                @if(old('nego_id') == $nego->id)
                            <option value="{{ $nego->id }}" selected>{{$nego->option }}</option>
                                @else
                            <option value="{{ $nego->id }}" selected>{{$nego->option }}</option>
                                 @endif
                            @endforeach
                        </select>
                    </div>
            </div>

            <div class="row mb-3">
                <label for="brand" name="brand" class="col-sm-2 col-form-label">Brand</label>
                <div class="col-sm-10">
                  <input type="brand" name="brand"  class="form-control @error('brand') is-invalid @enderror" id="brand" required value="{{ old("brand") }}" maxlength="255">
                  @error('brand')
                  <div class="invalid-feedback">
                   {{ $message }}
                  </div>
               @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="material" name="material" class="col-sm-2 col-form-label">Material</label>
                <div class="col-sm-10">
                  <input type="material"  name="material" class="form-control @error('brand') is-invalid @enderror" id="material" required value="{{ old("material") }}" maxlength="255">
                  @error('material')
                  <div class="invalid-feedback">
                   {{ $message }}
                  </div>
                 @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="description"  name="description" class="col-sm-2 col-form-label" >More Description(Optional)</label>
                <div class="col-sm-10">
                  <input type="description"   name="description" class="form-control" id="description" value="{{ old("description") }}" maxlength="255">
                </div>
            </div>

            <div class="meetup">
                <h6>Meet-Up Point</h6>
                <div class="col-12">
                    <input type="text" class="form-control @error('meetup_point') is-invalid @enderror" name="meetup_point" id="meetup_point" placeholder="KICT" required value="{{ old("meetup_point") }}" maxlength="255">
                    @error('meetup_point')
                    <div class="invalid-feedback">
                     {{ $message }}
                    </div>
                 @enderror
                  </div>
            </div>
            
            <button type="submit" class="btn_items mt-3 mb-3">Submit</button>
        </form>
   

    </div>
    
    
    @include('partials.footer')
    
    <script>
        function displaySelectedImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
    
                reader.onload = function (e) {
                    var selectedImage = document.getElementById('selectedImage');
                    selectedImage.src = e.target.result;
                    selectedImage.style.display = 'block';
                };
    
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>