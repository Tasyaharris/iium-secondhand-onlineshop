@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Users</h1>
</div>

  
<form action="/user/search" class="d-flex" style="margin-right:200px; width:500px" method="GET">
    <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search">
  </form>

    <!--success messages; later will be replaced with pop up alert/messages-->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>
    @endif

<table class="table table-responsive table-striped table-sm">
    <thead>
      <tr >
        <th scope="col">#</th>
    <th scope="col">User Id</th>
    <th scope="col">Username</th>
    <th scope="col">Product Listed</th>
    <th scope="col">Email</th>
    <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $user->id }}</td>
    <td>{{ $user->username }}</td>
    <td>{{ $user->products_count }}</td>
    <td>{{ $user->email }}</td>
    <td>
            <a href="{{ route('view.users', $user->id) }}" class="badge bg-primary-subtle">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                  </svg>
            </a>
            <form action="{{ route('delete.users', $user->id) }}"  method="post" class="d-inline">
              @method('DELETE')
              @csrf
              <button type="submit" onclick="return confirm('Are you sure to delete this user?')" class="badge bg-dark border-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                  </svg>
                </button>
            </form>
            <a href="{{ route('contact.users', $user->id) }}" class="badge bg-dark-subtle">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-chat-fill" viewBox="0 0 16 16">
                    <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9.06 9.06 0 0 0 8 15"/>
                  </svg>
            </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection
<script>

</script>
