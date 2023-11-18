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

      <!--success messages; later will be replaced with pop up alert/messages-->
      @if(session()->has('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif
   
       <!-- for menu selection -->
      <div class="row g-3 ">
       
        <div class="col-md-4">
        </div>
   

        <div class="col-md-8">
        <div class="container-under-table" style="margin-top: 50px;">
            <!-- Your container content under the table goes here -->
            <div class="selection-title">
                <h3>Edit Profile</h3>
            </div>
            
            <div class="edit-profile">
              <div class="row g-2" >
                <form method="post" action="/settings" enctype="multipart/form-data">
                    @csrf
                    
                     <!-- Image-->
                    <div class="inp-img" style="margin-top:40px;" >
                       <h5>Profile Photo</h5>
                       <img  class="profile-picture" src="" alt="User Profile Picture">
                       <button type="button" class="btn btn-light" name="profile_pic" id="profile_pic" style="margin-left:30px;">Upload Photo</button>
            
                    </div>

                    <div class="profile-details">

                        <!--name-->
                        <div class="form-floating mb-3 " style="margin-top: 40px;">
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name"  required value="{{ old('first_name', isset($oldInput['first_name']) ? $oldInput['first_name'] : (isset($profiles[0]->first_name) ? $profiles[0]->first_name : '')) }}" maxlength="255" style="text-transform: capitalize;">
                            @error('first_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="first_name">First Name</label>
                        </div>
                        
                        <div class="form-floating mb-3 " style="margin-top: 40px;">
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name"  required value="{{ old('last_name', isset($oldInput['last_name']) ? $oldInput['last_name'] : (isset($profiles[0]->last_name) ? $profiles[0]->last_name : '')) }}" maxlength="255" style="text-transform: capitalize;">
                            @error('last_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="last_name">Last Name</label>
                        </div>

                          <!--phone-->
                          <div class="form-floating mb-3 " style="margin-top: 40px;">
                            <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"  required value="{{ old('phone_number', isset($oldInput['phone_number']) ? $oldInput['phone_number'] : (isset($profiles[0]->phone_number) ? $profiles[0]->phone_number : '')) }}" maxlength="255" style="text-transform: capitalize;">
                            @error('phone_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="phone_number">Phone Number</label>
                           </div>

                          <!--mahallah-->
                          <div class="form-floating mb-3 " style="margin-top: 40px;">
                            <input type="text" name="mahallah" class="form-control @error('mahallah') is-invalid @enderror" id="mahallah"  required value="{{ old('mahallah', isset($oldInput['mahallah']) ? $oldInput['mahallah'] : (isset($profiles[0]->mahallah) ? $profiles[0]->mahallah : '')) }}" maxlength="255" style="text-transform: capitalize;">
                            @error('mahallah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="mahallah">Mahallah</label>
                        </div>

                          <!--kuliyyah-->
                          <div class="form-floating mb-3 " style="margin-top: 40px;">
                            <input type="text" name="kuliyyah" class="form-control @error('kuliyyah') is-invalid @enderror" id="kuliyyah"  required value="{{ old('kuliyyah', isset($oldInput['kuliyyah']) ? $oldInput['kuliyyah'] : (isset($profiles[0]->kuliyyah) ? $profiles[0]->kuliyyah : '')) }}" maxlength="255" style="text-transform: capitalize;">
                            @error('kuliyyah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="kuliyyah">Kuliyyah</label>
                           </div>

                            <!--bio-->
                          <div class="form-floating mb-3 " style="margin-top: 40px;">
                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio"   name="bio" value="{{ old('bio', isset($oldInput['bio']) ? $oldInput['bio'] : (isset($profiles[0]->bio) ? $profiles[0]->bio : '')) }}" style="margin-top: 7px; height:180px;"></textarea>
                            @error('bio')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="bio">Bio</label>
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