<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/buy.css">

 

  </head>
  <body>

    @include('partials.header')
    
    <div class="container mt-2">
        <nav class="navbar navbar-expand-lg  mb-0">
            <div >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                 <a href="/homepage">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                 </a>   
                </svg>
                <a href="/homepage" class=" p-3 text-secondary text-decoration-none d-inline" style="color: #000">Checkout</a>
            </div>
        </nav>
    </div>
    
    <!-- Modal for terms and conditions -->
    <div id="termsModal" class="modal">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terms and Conditions</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                <button id="acceptButton">Accept</button>
                <a href="/buypage" style="margin-left:3px; text-decoration:none; color: black;">Cancel</a>
            </div>
        </div>
        </div>
    </div>

    <form method="post" action="{{ route('buy.store', ['id' => $product->id, 'totalPrice' => $totalPrice]) }}" id="myForm">
    @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
    <!--address buyer-->
    <nav class="navbar bg-body-tertiary border-bottom mt-0" style="height: 100px;border: 1px solid #000;">
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
        <div class="manage-address justify-right" style="margin-left: 930px">
            <a href="/profile" style="color:black;font-size: 13px;">Manage Address</a>
        </div>
        <br>
    </nav>

    
    <!--username seller-->
    <nav class="navbar bg-body-tertiary border-bottom mt-0" style="height: 50px;border: 1px solid #000;">
        <div class="address1" style="display: inline-block;margin-left:30px;">
            <div style="text-align: center;">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16" style="margin-left: 10px;">
                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
            </svg>
            <a  class="p-3 text-decoration-none d-inline" style="font-weight: bold; color: black;">{{ $product->user->username }}</a>
            </div>
            <div style="text-align: center;">             
            </div>
            
        </div>
        <br>
    </nav>

     <!--product detail-->
     <nav class="navbar  border-bottom mt-0" style="height: 230px;border: 1px solid #000; ">
        <div class="product1" style="display:inline-block; margin-left:30px;">
            <div style="text-align: left; margin-left:10px;">
            <h6>Order Summary</h6>
            </div>

            <div class="product-container">
           
                <div class="product" style="display: flex; align-items: center;">
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
                       <small>Platform Fee: {{ $com }}</small>
                       <small>Total Fee : {{ $totalPrice }}</small>
                       <input type="hidden" name="product_id" value="{{ $totalPrice }}">

                     </div>
                     
                   </div>
            
            </div>
        </div>
        <br>
    </nav>
  
    <!--payment method-->
    <nav class="navbar  border-bottom mt-0" style="height: 100px;border: 1px solid #000; background-color: rgba(255, 240, 219, 0.35);">
        <div class="product1" style="display:inline-block; margin-left:30px;">
            <div style="text-align: left;">
            <h6>Payment Method: </h6>
            </div>
            <div style="text-align: center;">      
                @foreach ($payments as $payment) 
                <div class="form-check form-check-inline" id="paymentoption_id" name="paymentoption_id" required>   
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio{{ $payment->id }}" value="{{ $paymentoption_id}}" required>
                        <label class="form-check-label" for="inlineRadio{{ $payment->id }}">{{ $payment->payment_opt }}</label>
                </div>
                @endforeach
                
                  <div id="paymentError" class="alert alert-danger" style="display: none;">
                    Please select a payment method.
                </div>
            </div>
        </div>
        <br>
    </nav>
    
        <!--submit button-->
        <nav class="navbar border-bottom mt-0" style="height: 50px; border: 1px solid #000; background-color: #FFF0DB;">
            <div class="product1" style="display:inline-block; margin-left: 590px;text-align: center; justify-content:center;">
                    <button type="submit" id="showTermsBtn" class="order-button" style="border: none; background: transparent;">Place Order</button>
           
            </div>
            
        </nav>
    </form>
 
    @include('partials.footer')

    <script>
        const showTermsBtn = document.getElementById("showTermsBtn");
        const termsPopup = document.getElementById("termsModal");
        const acceptTermsCheckbox = document.getElementById("acceptTerms");
        const acceptButton = document.getElementById("acceptButton");
        const submitButton = document.getElementById("submitButton");
        const paymentError = document.getElementById("paymentError");

        showTermsBtn.addEventListener("click", () => {
        const paymentMethods = document.getElementsByName("inlineRadioOptions");
        let paymentMethodSelected = false;

         for (const method of paymentMethods) {
            if (method.checked) {
            paymentMethodSelected = true;
            break;
            }
        }

         if (paymentMethodSelected) {
            termsPopup.style.display = "block";
         }
        
        });   

        acceptButton.addEventListener("click", () => {
            if (acceptTermsCheckbox.checked) {
                termsPopup.style.display = "none";
               // Redirect to the home page when the "Accept" button is clicked
               document.getElementById("myForm").submit();
             }
          });

    document.getElementById("myForm").addEventListener("submit", (e) => {
        console.log("Form submitted!")
        if (!acceptTermsCheckbox.checked || !paymentMethodSelected) {
            e.preventDefault();
        }
    });
    </script>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    
</body>
</html>