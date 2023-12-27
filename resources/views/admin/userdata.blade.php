@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Users</h1>
</div>

<h6>User ID : {{ $user->id}}</h6>
<h6>Username : {{ $user->username}}</h6>
<h6>Email : {{ $user->email}}</h6>

<table class="table table-responsive table-striped table-sm mt-3">
    <thead>
      <tr >
        <th scope="col">#</th>
        <th scope="col">Prodcuct Id</th>
        <th scope="col">Product Name</th>
        <th scope="col">Price</th>
        <th scope="col">Condition</th>
        <th scope="col">Category</th>
        <th scope="col">Nego Option</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $product->id }}</td>
          <td>{{ $product->product_name }}</td>
          <td>{{  $product->product_price }}</td>
          <td>{{  $product->condition_name}}</td>
          <td>{{  $product->category}}</td>
          <td>{{  $product->nego_option}}</td>
          <td>{{  $product->statusProduct }}</td>
          <td>
            <form action="{{ route('delete.product', $product->id) }}"  method="post" class="d-inline">
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure to delete this product?')" class="badge bg-dark border-0">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                      <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                    </svg>
                  </button>
              </form>
          </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection
<script>

</script>