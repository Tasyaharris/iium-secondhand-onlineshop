@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Orders</h1>
  <form action="/order/search" class="ms-auto" style=" width:500px" method="GET">
    <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search">
  </form>
  
</div>



<table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Date</th>
        <th scope="col">Buyer</th>
        <th scope="col">Payment Method</th>
        <th scope="col">Order Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->order_date }}</td>
        <td>{{ $order->user_name }}</td>
        <td>{{ $order->option }}</td>
        <td>{{ $order->order_status }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection