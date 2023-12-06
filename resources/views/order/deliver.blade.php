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
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
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
                  <td class="clickable-row  {{ Request::is('listings') ? 'active' : ' ' }}"  data-href="/listings">
                    <a href="/listings">Preparing</a>
                  </td>
                  <td class="clickable-row active{{ Request::is('delivering') ? 'active' : ' ' }}" data-href="/reviews">
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
            

          
          <div style="display:flex; margin-top:15px;">
            <div id="roundedButton" class="radio-button" onclick="showAdditionalButton()"> </div> 
            <small style="margin-left:5px;">On my way to deliver</small>
          </div>
         
          <div style="display:flex; margin-top:15px; ">
          <a  id="additionalButton" class="hidden radio" href="{{ url('receive', $order->id) }}"></a>
          <small id="additionalButton1" class="hidden" style="margin-left:5px;">Arrived!</small>
          </div>
        </div>
        </div>

        
      </div>

      
      @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
      function showAdditionalButton() {
        var radioButton = document.getElementById('roundedButton');
        radioButton.classList.toggle('checked');

        var additionalButton = document.getElementById('additionalButton');
        

        var additionalButton1 = document.getElementById('additionalButton1');
        additionalButton.classList.toggle('hidden');
        additionalButton.classList.toggle('displayed');
        additionalButton1.classList.toggle('hidden');
        additionalButton1.classList.toggle('displayed');
    }

  


  </script>
  </body>
</html>