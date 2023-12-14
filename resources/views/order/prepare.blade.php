<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/footer.css">
    <style>
       .radio-button {
            border: 1px solid black;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .radio {
            border: 1px solid black;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hidden {
            display: none;
        }

        .displayed {
            display: block;
            margin-top: 10px; /* Adjust the margin as needed */
        }

        .additional-button {
            border-radius: 20px;
            padding: 10px 20px;
            background-color: #38c172;
            color: #fff;
            cursor: pointer;
        }

        .radio-button.checked {
        background-color: black; /* Change the background color when checked */
    }

        .radio.checked {
        background-color: black; /* Change the background color when checked */
    }
  </style>
  </head>
  <body>

      @include('partials.navbar')
      <div class="row g-3">
        <div class="col-md-4">
          <div class="user-profile">
            <div class="user-info">
              <div class="flex-container" style="display: flex; align-items: center;">
                <a href="javascript:history.back();" style="text-decoration: none; color: inherit;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16" style="margin-bottom: 3px;">
                  </svg>
                </a>
                <h6 style="margin-left:5px;">Delivery Item</h6>
              </div>
              <br>
             
              
            </div>
          </div>  
        </div>

        <div class="col-md-8">
            <nav class="side-navbar">
              <!-- Your sidebar content goes here -->
              <div class="table-container" style="margin-bottom:5px;">
              <table class="selection">
                <tr>
                  <td class="clickable-row active {{ Request::is('listings') ? 'active' : ' ' }}"  data-href="/listings">
                    <a href="/listings">Preparing</a>
                  </td>
                  <td class="clickable-row {{ Request::is('delivering') ? 'active' : ' ' }}" data-href="/reviews">
                    <a href="/reviews">Delivering</a>
                  </td>
                  <td class="clickable-row {{ Request::is('reviews') ? 'active' : ' ' }}" data-href="/reviews">
                    <a href="/reviews">Received</a>
                  </td>
                </tr>
              </table>
              </div>
            </nav>

            
        <div class="container-under-table" style=" border: none; margin-top:0;">
            <!-- Your container content under the table goes here -->
            <div class="products-listing" style="margin-top: 0px;">
              <div class="row g-2" > 
                <h6>Buyer: {{ $order->user->username }}</h6>
                <small style="font-weight: bold;font-size:15px;">Product(s) Name:</small>
                @foreach($order_items as $order_item)
                <br>
                <small style="font-size:15px;">{{ $order_item->product->product_name }}</small>
                @endforeach
                <div style="display: inline;">
                  <small style="font-weight: bold;font-size:15px;">Total: </small> RM{{ $order->totalOrder }}
                </div>
                <div style="display:inline;">
                <small style="font-weight: bold; font-size:15px;">Payment Method: </small>{{ $order->payment->payment_opt }}
                </div>
              </div>
            </div>

          
          <div style="display:flex; margin-top:15px;">
            <div id="roundedButton" class="radio-button " onclick="showAdditionalButton()"> </div> 
            <small style="margin-left:5px;">Prepare the Item</small>
          </div>
         
          <div style="display:flex; margin-top:15px; ">
          <a  id="additionalButton" class="hidden radio" href="{{ url('deliver', $order->id) }}"></a>
          <small id="additionalButton1" class="hidden" style="margin-left:5px;">Item prepared! Ready to deliver</small>
          </div>
        </div>
        </div>

        

      </div>

      
      @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <script>
      

      function showAdditionalButton() {
        // Update the UI (change color, show/hide elements, etc.)
        var radioButton = document.getElementById('roundedButton');
        var isAlreadyChecked = radioButton.classList.contains('checked');
        var additionalButton = document.getElementById('additionalButton');
        var isAlreadyChecked1 = additionalButton.classList.contains('checked');

                    if (!isAlreadyChecked) {
                        radioButton.classList.add('checked');      
                    }
                   
                      var additionalButton1 = document.getElementById('additionalButton1');
                      additionalButton.classList.remove('hidden');
                      additionalButton.classList.add('displayed');
                      additionalButton1.classList.remove('hidden');
                      additionalButton1.classList.add('displayed');
                   
                  }

  </script>
  </body>
</html>