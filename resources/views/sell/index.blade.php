<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet"
    />
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
        
    <!-- Modal for terms and conditions -->
    <div id="termsModal" class="modal">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terms and Conditions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your terms and conditions text here -->
                <p style="font-weight: bold">By listing an item for sale on the platform, I understand and acknowledge the following:</p>
                <p>1. I provided a detailed and accurate description of the item, including its condition, any damages, defects, or signs of wear and tear. I will also provide clear and high-quality images that represent the item's current state.</p>
                <p>2. I am fully responsible for the condition of the item at the time of sale. I understand that any misrepresentation or false information provided about the item's condition can lead to consequences, including potential disputes and loss of trust from buyers</p>
                <p>3. I disclosed any known damages, defects, or issues with the item to potential buyers. This includes visible damages, functionality concerns, missing parts, or any other significant information that may affect the buyer's decision to purchase the item.</p>
                <p>4. I understand that buyers have the right to expect transparency and accurate information about the item they are purchasing. I will address any inquiries or requests for additional information from potential buyers promptly and honestly.</p>
                <input type="checkbox" id="acceptTerms"> I agree to the Terms and Conditions
                <br>
                
            </div>
            <div class="modal-footer">
                <button id="acceptButton">Accept</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
            
        </div>
        </div>
    </div>

      <form method="post" action="/sell" enctype="multipart/form-data" id="myForm">
        @csrf
          <!--Image-->
           
          <div class="inp_img mb-3 mt-0" >
            <div class="elements-box" id="elementsBox">
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

                <input type="file" class="form-control @error('image') is-invalid @enderror d-none" id="customFile1" name="images[]" multiple required  required accept=".png, .jpg, .jpeg" onchange="displaySelectedImages(this)" />

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
         </div>

            <div class="img" >
                <div class="d-flex justify-content-center" id="selectedImagesContainer">
                </div>
            </div>

        </div>
 

        <div class="form-floating mb-3 mt-3">
                
            <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" id="product_name" placeholder="Item Name" required value="{{ old("product_name") }}" maxlength="255" style="text-transform: capitalize;">
            @error('product_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <label for="product_name">Item Name</label>
        </div>
 
        
        <div class="row mt-3">
            <div class="col-md-6">
                <label for="category_id">Product Category</label>
                <select class="form-select mb-3 mt-3" aria-label="Default select example" name="category_id" id="category_id" required >
                    <option selected >Select Category</option>
                    @foreach($categories as $category)
                        @if(old('category_id') == $category->id)
                            <option value="{{ $category->id }}"selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                     @endforeach
                </select>

            </div>
            <div class="col-md-6">
               <!-- Show subcategory dropdown only if a category is selected -->
               
               <label for="subcategory_id" style="color: white">Product Subcategory</label>
               <div class="form-check">
                   @foreach($subcategories as $subcategory)
                       <input class="form-check-input" type="checkbox" name="subcategory_ids[]" id="subcategory_{{ $subcategory->id }}" value="{{ $subcategory->id }}">
                       <label class="form-check-label" for="subcategory_{{ $subcategory->id }}">{{ $subcategory->name }}</label><br>
                   @endforeach
               </div>
            </div>
        </div>
        
            <div class="abt_product">
                <h5>About the product</h5>
                <br>
                <h6>Condition</h6>
                <p><a href="/cond_details">Please refer to condition details here</a></p>
            </div>
           
           

            <select class="form-select mb-3 mt-3" aria-label="Default select example" name="condition_id" id="condition_id" required>
                
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
                        <input type="text" name="product_price" class="form-control @error('price') is-invalid @enderror" id="product_price" aria-label="Text input with dropdown button" required value="{{ old("product_price") }}" pattern="[0-9]+">
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
                  <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" id="brand" required value="{{ old("brand") }}" maxlength="255">
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
                  <input type="text" name="material" class="form-control @error('brand') is-invalid @enderror" id="material" required value="{{ old("material") }}" maxlength="255">
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
                  <input type="text"   name="description" class="form-control" id="description" value="{{ old("description") }}" maxlength="255">
                </div>
            </div>

            <div class="meetup">
                <h6>Meet-Up Point</h6>
                <div class="col-12">
                    <input type="text" name="meetup_point" class="form-control @error('meetup_point') is-invalid @enderror"  id="meetup_point" placeholder="KICT" required value="{{ old("meetup_point") }}" maxlength="255">
                    @error('meetup_point')
                    <div class="invalid-feedback">
                     {{ $message }}
                    </div>
                 @enderror
                  </div>
            </div>
            
            <button type="submit" class="btn_items mt-3 mb-3" id="submitBtn" >Submit</button>
        </form>
   

    </div>
    
    
    @include('partials.footer')
    
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>
  // JavaScript to handle the modal and form submission
    var termsModal = document.getElementById("termsModal");
    const acceptTermsCheckbox = document.getElementById("acceptTerms");
    const acceptButton = document.getElementById("acceptButton");
    var submitButton = document.getElementById("submitBtn");
    var textFieldFilled = false;

    submitButton.addEventListener("click", () => {
        if (
            document.getElementById('product_name').value === '' ||
            document.getElementById('product_price').value === '' ||
            document.getElementById('brand').value === '' ||
            document.getElementById('material').value === '' ||
            document.getElementById('meetup_point').value === ''
        ){
            e.preventDefault();
        }else{
            textFieldFilled = true;
            termsModal.style.display = "block";
        }
        
    });

    acceptButton.addEventListener("click", function () {
        if (acceptTermsCheckbox.checked) {
            termsModal.style.display = "none";
            document.getElementById("myForm").submit();
        }
    });

    document.getElementById("myForm").addEventListener("submit", (e) => {
            if (!acceptTermsCheckbox.checked || !textFieldFilled) {
                e.preventDefault();
            }
        });
       
       

//to display images after selected
function displaySelectedImages(input) {
    var selectedImagesContainer = document.getElementById("selectedImagesContainer");
    selectedImagesContainer.innerHTML = ""; // Clear existing images

    var elementsBox = document.getElementById('elementsBox');

    for (var i = 0; i < input.files.length; i++) {
        var imageContainer = document.createElement("div");
        imageContainer.className = "selected-image-container";

         // Add individual "Remove" SVG button for each image
         var removeButton = createRemoveButton();

        // Use a block-scoped variable to capture the correct imageContainer
        let currentImageContainer = imageContainer;

        removeButton.addEventListener("click", function () {
            removeImage(currentImageContainer);
        });

        // Create a container for the image and the remove button
        var containerWithRemove = document.createElement("div");
        containerWithRemove.style.position = "relative";
        containerWithRemove.style.display = "inline-block"; 
        containerWithRemove.style.display="margin-top:0;"

        var image = document.createElement("img");
        image.src = URL.createObjectURL(input.files[i]);
        image.style.maxWidth = "100%";
        image.style.maxHeight = "200px";
        image.style.display = "block";

        // Append the image and the remove button to the container
        containerWithRemove.appendChild(image);
        containerWithRemove.appendChild(removeButton);

        imageContainer.appendChild(containerWithRemove);
        selectedImagesContainer.appendChild(imageContainer);
    }

    // Check if there are selected images to display
    if (input.files.length > 0) {
        elementsBox.style.display = "none"; // Hide elementsBox
    } else {
        elementsBox.style.display = "block"; // Show elementsBox
    }
}

// Separate function to create the "Remove" SVG button
function createRemoveButton() {
    var removeButton = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    removeButton.setAttribute("xmlns", "http://www.w3.org/2000/svg");
    removeButton.setAttribute("width", "25");
    removeButton.setAttribute("height", "25");
    removeButton.setAttribute("fill", "currentColor");
    removeButton.setAttribute("class", "bi bi-x-circle remove-icon");
    removeButton.setAttribute("viewBox", "0 0 16 16");

    var path1 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path1.setAttribute("d", "M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z");

    var path2 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path2.setAttribute("d", "M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z");

    removeButton.appendChild(path1);
    removeButton.appendChild(path2);

    return removeButton;
}

    // Separate function to handle image removal
    function removeImage(imageContainer) {
        // Remove the corresponding image and button
        imageContainer.remove();

        // Show elementsBox if there are no selected images
        var selectedImagesContainer = document.getElementById("selectedImagesContainer");
        var elementsBox = document.getElementById('elementsBox');
        elementsBox.style.display = selectedImagesContainer.children.length === 0 ? "block" : "none";
    }

    //to display subcategories based on category
    $(document).ready(function() {
        function updateSubcategories() {
            var selectedCategoryId = $('#category_id').val();

            $.ajax({
                url: '/get-subcategories/' + selectedCategoryId,
                type: 'GET',
                success: function(response) {
                    $('#subcategory_id option').hide();

                    $.each(response, function(index, subcategory) {
                        $('#subcategory_id option[value="' + subcategory.id + '"]').show();
                    });

                    $('#subcategory_id').val('Select Type');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        updateSubcategories();

        $('#category_id').on('change', function() {
            updateSubcategories();
        });
    });

    // to filled the prize with 0 if seller select for free
    document.addEventListener("DOMContentLoaded", function () {
        // Function to handle the change event of the seller option dropdown
        function handleSellerOptionChange() {
            var sellerOption = document.getElementById("option_id").value;
            var priceInput = document.getElementById("product_price");

             // Check if the selected seller option is "For Free"
             if (sellerOption === "2") { // Assuming "1" is the value for the "For Free" option
                // Set the price input value to 0 and disable the input
                priceInput.value = "0";
                priceInput.setAttribute("readonly", true);
            } else {
                // If a different option is selected, enable the input
                priceInput.value = ""; // Clear the input value
                priceInput.removeAttribute("readonly");
            }
        }

        // Attach the handleSellerOptionChange function to the change event of the seller option dropdown
        document.getElementById("option_id").addEventListener("change", handleSellerOptionChange);

        // Trigger the initial execution of the function to set the initial state
        handleSellerOptionChange();
    });

    //2 decimal digit in price
    document.addEventListener("DOMContentLoaded", function () {
        var priceInput = document.getElementById("product_price");

        priceInput.addEventListener("input", function (event) {
            // Remove non-numeric characters
            var numericValue = event.target.value.replace(/[^0-9]/g, '');

            // Format the numeric value with two decimal places
            var formattedValue = (numericValue / 100).toFixed(2);

            // Update the input value
            event.target.value = formattedValue;
        });
    });

    </script>
    
   
  </body>
</html>