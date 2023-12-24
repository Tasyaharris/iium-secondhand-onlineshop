@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Overview</h1>
</div>

<div  style="display: flex; align-items:center;margin-bottom:10px;">
<div class="col-md-4 mb-3">
<div class="card  bg-body-tertiary" style="width: auto; border-radius:10px;margin-left:10px;">
  <div class="card-body">
    <h5 class="card-title mb-2">Total Users</h5>
    <div style="display: flex; align-items:center;">
    <img src="/images/customer.png" alt="logo" width="100" height="100">
    <div class="stack text-center" style="margin-left:40px;">
    <h1 >{{ $totalUsers }}</h1>
    <h4 style="align-text:center;">Registered Users</h4>
    </div>
   </div>
  </div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card  bg-body-tertiary" style="width: auto; border-radius:10px;margin-left:20px;">
  <div class="card-body">
    <h5 class="card-title mb-2">Total Products</h5>
    <div style="display: flex; align-items:center;">
    <img src="/images/products.png" alt="logo" width="100" height="100">
    <div class="stack text-center" style="margin-left:40px;">
    <h1 >{{ $totalProducts }}</h1>
    <h4 style="align-text:center;">Products Listed</h4>
    </div>
   </div>
  </div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card  bg-body-tertiary" style="width: auto; border-radius:10px;margin-left:20px;">
  <div class="card-body">
    <h5 class="card-title mb-2">Orders</h5>
    <div style="display: flex; align-items:center;">
    <img src="/images/orders.png" alt="logo" width="100" height="100">
    <div class="stack text-center" style="margin-left:40px;">
    <h1 >{{ $totalOrders }}</h1>
    <h4 style="align-text:center;">Completed Orders</h4>
    </div>
   </div>
  </div>
</div>
</div>
</div>

<div class="container">
  <div class="row">
    <!-- Products table -->
    <div class="col-md-6">
      <table class="table table-striped table-sm">
        <thead>
          <h3>Products</h3>
          <tr>
            <th scope="col">Category</th>
            <th scope="col">Total Products</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
            <tr>
              <td>{{ $category->name}}</td>
              <td>{{ $category->products->count() }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Sales card -->
    <div class="col-md-6">
      <h3>Sales</h3>
      <div class="card mt-4" style="width: auto; border-radius: 10px; margin-left: 20px; background: rgba(0, 0, 0, 0.75);">
        <div class="card-body">
          <div style="text-align:center;color:white;">
            <h3 style="text-align: center;">{{ $totalSoldProducts }} Product Sold</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection

