<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/settings.css">
    <link rel="stylesheet" href="/css/footer.css">
  </head>
  <body>

      @include('partials.navbar')

       <!-- Modal for the message -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
                Dear users,
                <br>
                Thank you for providing your bank account details for transaction purposes on our platform. We want to assure you that the information you've shared is handled with the utmost care and will be kept confidential.
                <br>
                Your bank account number is securely stored and will only be accessed for transaction-related purposes.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!--success messages; later will be replaced with pop up alert/messages-->
      @if(session()->has('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif
   
       <!-- for menu selection -->
      <div class="row g-3 ">
       
        <div class="col-md-4">
          <div class="card mt-5" style="border: none;">
            <div class="card-body" style="border: none;">             
                <ul class="list-group" >
                    <li class="list-group-item">
                        <a href="" style="text-decoration: none; color:black;">Reset Password</a>
                    </li>
                    <li class="list-group-item">
                        <a href="" style="text-decoration: none; color:black;">Add Bank Account Details</a>
                    </li>
                    <!-- Add more dashboard options as needed -->
                </ul>
            </div>
        </div>
        </div>
   

        <div class="col-md-8">
        <div class="container-under-table" style="margin-top: 50px;">
            <!-- Your container content under the table goes here -->
            <div class="selection-title">
                <h3>Bank Account Details</h3>
            </div>
            
            <div class="edit-profile">
              <div class="row g-2" >
                <form method="post" action="/payment">
                    @csrf
                    <div class="profile-details">
                        <!--name-->
                        <div class="form-floating mb-3 " style="margin-top: 40px;">
                            <input type="text" name="bankName" class="form-control @error('bankName') is-invalid @enderror" id="bankName"  required value="{{ old('bankName', isset($oldInput['bankName']) ? $oldInput['bankName'] : (isset($banks[0]->bankName) ? $banks[0]->bankName : '')) }}" maxlength="255" style="text-transform: capitalize;">
                            @error('bankName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label for="bankName">Name of the Bank</label>
                        </div>
                        
                        <div class="form-floating mb-3 " style="margin-top: 40px;">
                            <input type="text" name="accountNumber" class="form-control @error('accountNumber') is-invalid @enderror" id="accountNumber"  required value="{{ old('accountNumber', isset($oldInput['accountNumber']) ? $oldInput['accountNumber'] : (isset($banks[0]->accountNumber) ? $banks[0]->accountNumber : '')) }}" maxlength="255" style="text-transform: capitalize;">
                            @error('accountNumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="accountNumber">Account Number</label>
                        </div>
           
                    </div>

                    <button type="submit" class="btn_items mt-3 mb-3" id="submitBtn" >Submit</button>

                </form>
      
              </div>
        

            </div>
         </div>
       
        </div>
    </div>
      
      
      
      
    
      @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
  </body>
</html>