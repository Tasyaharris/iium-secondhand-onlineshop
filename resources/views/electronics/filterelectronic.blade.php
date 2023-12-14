
<section class="header border-bottom mt-0" id="header">

    <nav class="navbar bg-body-tertiary mt-0 " style="border: 1px solid #000; ">
      <div class="container-fluid" >
      
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle1" type="button" id="subcategoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
            @if(count($subcategories) > 0)
            {{ $subcategories[0]->name }}
            @else
            Select Subcategories
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
            </svg>
          </button>
          <div class="dropdown-menu1" aria-labelledby="subcategoryDropdown">
              @foreach($subcategories as $subcategorie)
                  <div class="form-check" style="margin-left:5px;">
                      <input class="form-check-input" type="checkbox" name="subcategory_ids[]"  id="subcategory_{{ $subcategorie->id }}" {{ in_array($subcategorie->id, $subCategoryInputs) ? 'checked' : '' }} value="{{ $subcategorie->id }}"   onchange="filterProductsBySubCategories(this)">
                      <label class="form-check-label" for="subcategory_{{ $subcategorie->id }}">
                          {{ $subcategorie->name }}
                      </label>
                  </div>
              @endforeach
          </div>
        </div>
    
        <!--price-->
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle3" type="button" id="conditionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Price
           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
          </svg>
          </button>
          <div class="price-inputs3" id="priceInputs">
            <div class="row">
              <div class="col-md-6">
                <label for="minPrice" class="form-label">Min Price</label>
                <input type="number" class="form-control" id="minPrice" name="minPrice" placeholder="Enter Min Price">
              </div>
              <div class="col-md-6">
                <label for="maxPrice" class="form-label">Max Price</label>
                <input type="number" class="form-control" id="maxPrice" name="maxPrice" placeholder="Enter Max Price">
              </div>
            </div>
            <div class="mt-2">
              <button class="btn btn-secondary" onclick="applyPriceFilter()">Apply Price Filter</button>
          </div>
          </div>
        </div>
  
       
         <!--condition-->
         <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle2" type="button" id="conditionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Condition
           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
          </svg>
          </button>
          <div class="dropdown-menu2" aria-labelledby="conditionDropdown">
            @foreach($conditions as $condition)
            <div class="form-check" style="margin-left:5px;">
                <input class="form-check-input" type="checkbox" name="condition[]" {{ in_array($condition->id, $conditionInputs) ? 'checked' : '' }} value="{{ $condition->id }}" onchange="filterProductsByCondition(this)" >
                <label class="form-check-label">
                    {{ $condition->condition }}
                </label>
            </div>
          @endforeach
          </div>
        </div>
        
             <!--sorting-->
             <select id="sortingSelect" class="form-select form-select-sm custome-select text-center" aria-label=".form-select-sm example" style="margin-right: 30px;background-color: #6c757d;color: white;">
              <option selected>Sorting</option>
              <option value="1" class="text-left">Sort by Price: High to Low</option>
              <option value="2" class="text-left">Sort by Price: Low to High</option>
              <option value="3" class="text-left">Sort by Newness</option>
            </select>
  
  
  
      </div>
    </nav>
  
   
  </section>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  
  <script>
    // Add an event listener for sorting select change
    document.getElementById('sortingSelect').addEventListener('change', function () {
        var sortingOption = this.value;
  
        // Send an Ajax request to the server to sort products
        $.ajax({
            type: 'POST',
            url: '{{ route('sort.electronics') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'sortingOption': sortingOption
            },
            success: function (response) {
                // Update the products on the page with the sorted data
                updateProducts(response);
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
  </script>
  <script>
    //for price filter
    function applyPriceFilter() {
          var minPrice = document.getElementById("minPrice").value;
          var maxPrice = document.getElementById("maxPrice").value;
  
          // Send an Ajax request to the server to filter products based on min and max price
          $.ajax({
              type: 'POST',
              url: '{{ route('filter.electronics') }}',
              data: {
                  '_token': '{{ csrf_token() }}',
                  'minPrice': minPrice,
                  'maxPrice': maxPrice
              },
              success: function (response) {
                  // Update the products on the page with the filtered data
                  updateProducts(response);
              },
              error: function (error) {
                  console.error(error);
              }
          });
      }
  
    //for condition filter
      function filterProductsByCondition(checkbox) {
      
      var selectedCondition = [];
      document.querySelectorAll('input[name="condition[]"]:checked').forEach(function(checkbox) {
         selectedCondition.push(checkbox.value);
      });
  
      // Send an Ajax request to the server
      $.ajax({
          type: 'POST',
          url: '{{ route('filter.electronics') }}',
          data: {
              '_token': '{{ csrf_token() }}',
              'condition_ids': selectedCondition
          },
          success: function (response) {
              // Update the products on the page with the filtered data
              updateProducts(response);
          },
          error: function(error) {
              console.error(error);
          }
      });
  }
  
  //for subcategory filter
  function filterProductsBySubCategories(checkbox) {
      
      var selectedSubCategories = [];
      document.querySelectorAll('input[name="subcategory_ids[]"]:checked').forEach(function(checkbox) {
        selectedSubCategories.push(checkbox.value);
      });
  
      // Send an Ajax request to the server
      $.ajax({
          type: 'POST',
          url: '{{ route('filter.electronics') }}',
          data: {
              '_token': '{{ csrf_token() }}',
              'subcategorie_ids': selectedSubCategories
          },
          success: function (response) {
              // Update the products on the page with the filtered data
              updateProducts(response);
    
          },
          error: function(error) {
              console.error(error);
          }
      });
  }
  
  // Function to update the products on the page
  function updateProducts(response) {
     // Clear the existing products in the #products-section
     $('#products-section').empty();
      // Check if the response is not empty and contains products
      if (response && response.view) {
          // Replace the content of #products-section with the HTML from the server
          $('#products-section').html(response.view);
      } else {
         // Handle the case where no products are returned or the response is empty
         var message = response && response.view ? 'No products found.' : 'There is no product.';
          $('#products-section').html('<div class="username"><h6>' + message + '</h6></div>');
      }
  }
  
  
    $(document).ready(function() {
      $(".dropdown-menu1").hide();
      $(".dropdown-menu2").hide();
      $(".price-inputs3").hide();
  
      $(".dropdown-toggle1").click(function() {
        $(".dropdown-menu1").toggle();
      });
  
      $(".dropdown-toggle2").click(function() {
        $(".dropdown-menu2").toggle();
      });
  
      $(".dropdown-toggle3").click(function() {
        $(".price-inputs3").toggle();
      });
    });
  
    
  </script>
  