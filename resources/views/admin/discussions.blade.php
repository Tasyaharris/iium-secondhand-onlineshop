@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Discussions</h1>
</div>

@include('admin.layouts.search')

  <!--success messages; later will be replaced with pop up alert/messages-->
  @if(session()->has('success'))
  <div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>
  @endif

<div class="col-md-16" style="">
    <!-- Content for the second half of the page -->
    @foreach ($discussions->take(5) as $discussion)
    <nav class="navbar bg-body-tertiary mt-3 " style="border:1px solid grey;border-radius:10px;width:auto;">
      <div class="row" >
      <div class="discussion-bar"  data-discussion-id="{{ $discussion->id }}" >
        <!--seller profile-->
          <div class="text-left" style="display: flex; align-items: center;">
              <div class="col-md-0" style="margin-left: 25px;" >
                  <h6>{{ $discussion->user_name }}</h6>
              </div>
              <div class="col-md-18 d-flex" style="align-items: center;">
              <div class="row" style="margin-left: 7px;" >
                  <h6>{{ $discussion->title }}</h6>
                  <p>{{ $discussion->discussion }}</p>
              </div>
              </div>
             
                     <!--delete item button-->
              <div class="ma-auto">
                <form action="{{ route('delete.discussion', $discussion->id) }}"  method="post">
                  <span class="dropdown-item">
                  @method('DELETE')
                  @csrf
                  <button type="submit" onclick="return confirm('Are you sure to delete this discussion?')" style="border: none; background-color: none;">
                    <i class="fas fa-trash mx-2"></i> 
                  </button>
                  </span>
                </form>  
             </div>          
          </div> 
      </div>

   
      
      <div class="comments-container" style="display: none;"  data-discussion-id="{{ $discussion->id }}"> <!-- Initially hide comments -->
          <livewire:comments :model="$discussion"/>
      </div>
    </div>
  </nav>
    @endforeach
    
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
    <script>
      // JavaScript to toggle comments visibility
      document.addEventListener('DOMContentLoaded', function () {
          var discussionBars = document.querySelectorAll('.discussion-bar');
  
          discussionBars.forEach(function (discussionBar) {
              discussionBar.addEventListener('click', function () {
                  var commentsContainer = this.nextElementSibling;
  
                  if (commentsContainer.style.display === 'none') {
                      commentsContainer.style.display = 'block';
                  } else {
                      commentsContainer.style.display = 'none';
                  }
              });
          });
      });
  </script>