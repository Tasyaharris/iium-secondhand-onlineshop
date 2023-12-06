<div class="col-md-4">
    <div class="user-profile">
      <div class="user-info">
        @foreach ($profiles as $profile)
        <div class="flex-container">
          <img  class="profile-picture" src="images/books.png" alt="User Profile Picture">
          <div class="uname">
            <div class="nameuser">
              <h6 >{{ $profile->first_name }} </h6>
              <h6>{{ $profile->last_name }}</h6>
            </div>
           
            <p>{{ auth()->user()->username }}</p>
          </div>
        </div>
        <br>
          <div class="location">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
          <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
          </svg> 
          <p>{{ $profile->mahallah }}</p>
          </div>
        @endforeach
      </div>
    </div>
    
  </div>