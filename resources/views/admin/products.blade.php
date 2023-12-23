@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Products</h1>
</div>

<table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Id</th>
        <th scope="col">Seller</th>
        <th scope="col">Product Name</th>
        <th scope="col">Category</th>
        <th scope="col">Status Products</th>
      </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
      <tr>
        <td>1</td>
        <td>{{ $product->id }}</td>
        <td>{{ $product->user_name }}</td>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->category_name }}</td>
        <td>{{ $product->statusproduct }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection