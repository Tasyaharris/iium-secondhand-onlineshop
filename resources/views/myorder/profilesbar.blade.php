<div class="col-md-4">
    <div class="user-profile">
      <div class="user-info">
        @if ($profiles->isEmpty())
        <!-- Show a button to fill profile details -->
        <p>{{ auth()->user()->username }}</p>
        <a type="button" class="btn btn-secondary mt-3" href="/settings" >Please fill in your profile </a>
    @else
        {{-- Display profile information --}}
        @foreach ($profiles as $profile)
            <div class="flex-container">
                @if ($profile->profile_pic)
                    <img class="profile-picture" src="{{ asset('storage/' . $profile->profile_pic) }}" alt="User Profile Picture">
                @else
                    <!-- Default image if profile_pic is not set -->
                    <img class="profile-picture" src="{{ asset('images/default-profile-pic.png') }}" alt="Default Profile Picture">
                @endif
                <div class="uname">
                    <div class="nameuser">
                        <h6>{{ $profile->first_name }}</h6>
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

    @endif
      </div>
    </div>
    
  </div>