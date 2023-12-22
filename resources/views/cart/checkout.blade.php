<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/buy.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 

  </head>
  <body>

    @include('partials.header')
    
    <div class="container mt-1">
        <nav class="navbar navbar-expand-lg  mb-0">
            <div style="display: flex;align-items:center;">
                <a href="javascript:history.back();" style="text-decoration: none; color: black;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16" style="text-decoration: none; color: black; margin-left:px; margin-top:5px;">
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
                    </svg>
                </a>
                <a href="" class=" p-2 text-secondary text-decoration-none d-inline" style="color: #000">Checkout</a>
            </div>
        </nav>
    </div>
    
    <!-- Modal for terms and conditions -->
    <div id="termsModal" class="modal">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terms and Conditions</h5>
                <button type="button" id="closeBtn" class="btn-close" data-bs-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your terms and conditions text here -->
                <p style="font-weight: bold">Terms and Conditions: </p>
                <p>1. We hereby declares that it bears no responsibility for any transactions conducted between sellers and buyers on the platform, including any incidents or issues that may occur before, during, or after a transaction.</p>
                <p>2. We acknowledges that this website serves solely as a facilitator, providing a platform for sellers to list their items and for buyers to browse and purchase these items. The website does not participate in or influence any negotiations, agreements, or transactions between sellers and buyers.</p> 
                <p>3. In the event of any disputes or issues arising from a transaction, the website administration encourages buyers to engage in open communication with the seller directly. </p>
                <input type="checkbox" id="acceptTerms"> I agree to the Terms and Conditions
                <br>
                <br>
                <button id="acceptButton">Continue Order</button>
               
            </div>
        </div>
        </div>
    </div>

    <form method="post" action="{{ url('buy') }}" id="myForm" enctype="multipart/form-data">
        @csrf
        
    <!--address buyer-->
    <nav class="navbar bg-body-tertiary border-bottom mt-0" style="height: 100px; border: 1px solid #000; display: flex; align-items: center;">
        <div class="address1" style="display: inline-block;">           
            <div style="text-align: center; margin-left:20px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16" style="margin-left: 10px;">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                </svg>
                <a href="/homepage" class="p-3 text-decoration-none d-inline" style="font-weight: bold; color: black; text-align: left; ">Address</a>
            </div>
            @foreach ($profiles as $profile)
            <div style="text-align: left; margin-top:3px; ">
                <small style="margin-left:60px;"> Mahallah {{ $profile->mahallah }}</small>
            </div>
            @endforeach
        </div>
        <div class="manage-address" style="margin-left: auto; margin-right:20px;">
            <a href="/profile" style="color: black; font-size: 13px;">Manage Address</a>
        </div>
    </nav>
    

    
    <!--username seller-->
    @foreach($products->groupBy('user.username') as $username => $productGroup)
    <nav class="navbar bg-body-tertiary border-bottom mt-0" style="height: 50px;border: 1px solid #000;">
        <div class="address1" style="display: inline-block;margin-left:30px;">
            <div style="text-align: center;">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16" style="margin-left: 10px;">
                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
            </svg>
            <a  class="p-3 text-decoration-none d-inline" style="font-weight: bold; color: black;">{{ $username }}</a>
            
            </div>
            <div style="text-align: center;">             
            </div>
            
        </div>
        <br>
    </nav>

     <!--product detail-->
     <nav class="navbar  border-bottom mt-0" style="height: auto;border: 1px solid #000; ">
        <div class="product1" style="display:inline-block; margin-left:30px;">
            <div style="text-align: left; margin-left:10px;">
            <h6>Order Summary</h6>
            </div>

            <div class="product-container1">
                @foreach($productGroup as $product)
                <input type="hidden" name="product_id[]" value="{{ $product->product_id }}">
                <div class="col " style="display: flex; align-items: center; margin-top:10px;">
                    <!--product details--> 
                    <div class="col text-center" style="margin-left: 10px;">  
                        @if (is_array(json_decode($product->product_pic)))
                        @php $firstImagePath = json_decode($product->product_pic)[0]; @endphp
                                  <div class=" img_recom" style="margin-left: 3px; margin-bottom:0px">
                                      <img src="{{ asset('storage/' . $firstImagePath) }}"width="130" height="130" >
                                  </div>   
                        @endif
                     </div>
                     
                     <div class="row" style="margin-left:5px;">
                        <h6>{{ $product->product_name }}</h6>
                        <br>
                       <small>Item Price: RM {{ $product->product_price }}</small>
                       <small>Platform Fee: RM {{ $com }}</small>
                       <small>Total Fee : RM {{ $totalPrice }}</small>
                       
                     </div>
                </div>
                @endforeach

                <h6 style="margin-top:10px;margin-left:30px;">Total Order: RM{{ $totalOrder }} </h6>
                 <input type="hidden" name="totalOrder" value="{{ $totalOrder }}">
               
            </div>
        <br>
    </nav>
    @endforeach

     <!--payment method-->
     <nav class="navbar  border-bottom mt-0" style="height: auto;border: 1px solid #000; background-color: rgba(255, 240, 219, 0.35);">
        <div class="product1" style="display:inline-block; margin-left:30px;">
            <div style="text-align: left;">
            <h6>Payment Method: </h6>
            </div>
            <div style="text-align: left;">      
                @foreach ($payments as $payment) 
                <div class="form-check form-check-inline" id="paymentoption_id" required>   
                    @if ($payment->id == 2 && !$product->user->bstatus)
                        <input class="form-check-input" type="radio" name="paymentoption_id" id="inlineRadio{{ $payment->id }}" value="{{  $payment->id}}" required disabled>
                        <label class="form-check-label" for="inlineRadio{{ $payment->id }}">Online Transfer (Seller only accepts cash payment)</label>
                    @else
                        <input class="form-check-input" type="radio" name="paymentoption_id" id="inlineRadio{{ $payment->id }}" value="{{  $payment->id}}" required>
                        <label class="form-check-label" for="inlineRadio{{ $payment->id }}">{{ $payment->payment_opt }}</label>
                    @endif
                </div>
            @endforeach
                
                <div id="paymentError" class="alert alert-danger" style="display: none;">
                    Please select a payment method.
                </div>

                <!--upload payment proof-->
                <div class="file-upload-container mt-2" id="fileUploadContainer" style="display: none;">
                    <div class="bank-info mt-2" style="text-align:left;">
                        @if ($product->bank)
                        <small>Bank: {{ $product->user->bank->bankName }}</small>
                        <br>
                        <small>Name: {{ $product->user->bank->nameInBank }}</small>
                        <br>
                        <small>Account Number: {{ $product->user->bank->accountNumber }}</small>
                    @else
                        <small>No bank information available</small>
                    @endif
                </div>

                    <label for="paymentProof" style="font-size: 15px;margin-top:5px;">Upload Payment Proof:</label>
                    <input type="file" id="paymentProof" name="paymentProof" accept=".pdf, .jpeg, .jpg, .png">
                </div>
            </div>
        </div>
        <br>
    </nav>

     <!--delivery place-->
     <nav class="navbar  border-bottom mt-0" style="height:auto;border: 1px solid #000;">
        <div class="product1" style="display:inline-block; margin-left:30px;">
            <div style="text-align: left;">
            <h6>Delivery Option: </h6>
            </div>
            <div style="text-align: center;">      
                @foreach ($deliveries as $delivery) 
                <div class="form-check form-check-inline" id="delivery_id" required>   
                        <input class="form-check-input" type="radio" name="delivery_id" id="inlineRadio{{ $delivery->id }}" value="{{  $delivery->id}}" required>
                        <label class="form-check-label" for="inlineRadio{{ $delivery->id }}">{{ $delivery->del_option }}</label>
                </div>
                @endforeach   
               
                <div id="deliveryError" class="alert alert-danger" style="display: none;">
                    Please select a delivery method.
                </div>

                <!-- Add the container for the address input -->
                <div class="address-input-container mt-1" id="addressInputContainer" style="display: none;">
                    <label for="del_place" style="display:none;"></label>
                    <input type="text" id="del_place" name="del_place" class="form-control" placeholder="Enter your delivery address" value="{{ old("del_place") }}" maxlength="255">
                </div>

                <!-- display meeting point -->
                <div class="meetup_point" id="meetup_point" style="display: none;text-align:left;">
                    <small id="meeting_point">Meeting Point: {{ $product->meetup_point }}</small>
                </div>

            </div>
        </div>
        <br>
    </nav>
    
        <!--submit button-->
        <nav class="navbar border-bottom mt-0" style="height: 50px; border: 1px solid #000; background-color: #FFF0DB; display: flex; justify-content: center; align-items: center;">
            <div class="product1">
                <button type="submit" id="showTermsBtn" class="order-button" style="border: none; background: transparent;">Place Order</button>
            </div>
        </nav>
        
    </form>
 
    @include('partials.footer')

    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        var termsModal = document.getElementById("termsModal");
       const closeBtn = document.getElementById("closeBtn");
       closeBtn.addEventListener("click", function () {
       
            termsModal.style.display = "none";
           
        });
</script>
<script>
    $(document).ready(function () {
        const showTermsBtn = $("#showTermsBtn");
        const termsPopup = $("#termsModal");
        const acceptTermsCheckbox = $("#acceptTerms");
        const acceptButton = $("#acceptButton");
        const myForm = $("#myForm");
        const paymentError = $("#paymentError");

        showTermsBtn.on("click", function () {
            const paymentMethods = $("[name='paymentoption_id']");     
            let paymentMethodSelected = false;
       
            paymentMethods.each(function () {
                if ($(this).prop("checked")) {
                    paymentMethodSelected = true;
                    return false; // exit the loop
                }
            });
         
            if (paymentMethodSelected) {
             // Get an array of product IDs from the checkboxes
             const productIds = $('[name="product_id[]"]:checked').map(function () {
                 return $(this).val();
             }).get();
         
             // Append the product_ids as hidden inputs to the form
             productIds.forEach(function (productId) {
                 const productIdInput = $("<input>").attr({
                     type: "hidden",
                     name: "product_id[]",
                     value: productId
                 });
                 myForm.append(productIdInput);
             });

             termsPopup.modal("show");
             }
        });

        // Handle the change event of the payment options
        $('[name="paymentoption_id"]').on("change", function () {
            const selectedPaymentId = $('[name="paymentoption_id"]:checked').val();

            // Check if the selected payment option requires a file upload
            if (selectedPaymentId == 2) {
                // Show the file upload container
                $('#fileUploadContainer').show();
            } else {
                // Hide the file upload container
                $('#fileUploadContainer').hide();
            }
        });

        //handle the change event deliver
        $('[name="delivery_id"]').on("change", function () {
            const selectedDeliveryId = $('[name="delivery_id"]:checked').val();

            // Check if the selected delivery option requires an address
            if (selectedDeliveryId == 1) {
                // Show the address input container
                $('#addressInputContainer').show();
            } else {
                // Hide the address input container
                $('#addressInputContainer').hide();
            }

            if (selectedDeliveryId == 2){
                $('#meetup_point').show();
            }else{
                $('#meetup_point').hide();
            }
        });

          
        acceptButton.on("click",  async function () {
            if (acceptTermsCheckbox.prop("checked")) {
                let myRealForm = document.getElementById('myForm')

               // showTermsBtn.prop("disabled", true);

                // Submit the form using AJAX
                // $.ajax({
                //     type: myForm.attr("method"),
                //     url: myForm.attr("action"),
                //     data: myForm.serialize(),
                //     success: function (response) {
                        
                //     },
                //     error: function (error) {
                       
                //     }
                // });

              const data = new URLSearchParams(new FormData(myRealForm));
                await fetch(myForm.attr("action"),{
                    method:'POST',
                    mode:'cors',
                    header:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    redirect: "follow", 
                    body:data
                }).then( data =>{
                    console.log(data)
                    termsPopup.modal("hide");
                    window.open(data.url,"_self")
                    console.debug("FORM SUCCESS")
                }).catch(
                    err => console.error(err)
                ) 
            }
        });

        myForm.on("submit", function (e) {
            console.log("Form submitted!");
            if (!acceptTermsCheckbox.prop("checked") || !$("[name='paymentoption_id']:checked").length) {
                e.preventDefault();
            }
        });
    });
</script>
    
</body>
</html>