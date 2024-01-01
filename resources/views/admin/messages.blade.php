@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">User Messages</h1>
</div>

  <!--success messages; later will be replaced with pop up alert/messages-->
  @if(session()->has('success'))
  <div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>
  @endif

  <nav class="col-md-3 side-navbar">
    <div class="table-container"  >
    <table class="selection" style=" margin:0;padding:0;   background-color: white; text-align: center;">
      <tr style=" background-color: white; text-align: center;">
        <td class="clickable-row active {{ Request::is('recent') ? 'active' : ' ' }}"  data-href="/adminmessage" style=" padding: 10px;border: 1px solid black;width: 185px;">
          <a href="/adminmessage" style="color: black; text-decoration:none;">Recent</a>
        </td>
        <td class="clickable-row {{ Request::is('yourdiscussion') ? 'active' : ' ' }}" data-href="/yourdiscussion" style=" padding: 10px;border: 1px solid black;width: 185px;">
          <a href="/replied" style="color: black;text-decoration:none;">Replied</a>
        </td>
      </tr>
    </table>
    </div>
  </nav>

<div class="col-md-16" style="">
    <!-- Content for the second half of the page -->
    <div class="discussion-container" style="max-height: 500px; overflow-y: auto;">
    @foreach ($messages->take(5) as $message)
    <nav class="navbar bg-body-tertiary mt-3 " style="border:1px solid grey;border-radius:10px;width:auto;">
      <div class="row" >
      <div class="discussion-bar"  >
        <!--seller profile-->
          <div class="text-left" style="display: flex; align-items: center;">
              <div class="col-md-18 d-flex" style="align-items: center;">
              <div class="row" style="margin-left: 7px;" >
                  <h6>{{ $message->title }}</h6>
                  <p>{{ $message->message }}</p>
              </div>
              </div>
             
          </div> 
      </div>
      @foreach ($message->replies as $reply)
      <div role="alert" style="margin-left:20px;">
    
            <h6 style="font-weight: bold; margin-right:7px;">{{ $reply->user->username }}:</h6>
            <p>{{ $reply->body }}</p>
        
    </div>
      @endforeach

      <!-- Reply form - Display only if there are no replies -->
      @if($message->replies->isEmpty())
      <form action="{{ route('reply.store') }}" method="post" style="margin-left:20px;">
          @csrf
          <div class="mb-3">
              <label for="reply_message" class="form-label">Reply Message:</label>
              <textarea class="form-control" id="reply_message" name="reply_message" rows="3"></textarea>
          </div>
          <input type="hidden" name="parent_message_id" value="{{ $message->id }}">
          <button type="submit" class="btn btn-dark">Reply</button>
      </form>
      @endif
     

    </div>
  </nav>
    @endforeach
    </div>
    
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
