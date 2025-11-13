@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Customer Details</span>
                    <a href="{{ route('customers.index') }}" class="btn btn-secondary btn-sm">Back</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">ID:</th>
                            <td>{{ $customer->id }}</td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>{{ $customer->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $customer->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $customer->phone }}</td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>{{ $customer->address }}</td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $customer->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At:</th>
                            <td>{{ $customer->updated_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>

                    <div class="mt-3">
                        <h5>Order History</h5>
                        @if($customer->orders->count() > 0)
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customer->orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->product->name }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>${{ number_format($order->total_price, 2) }}</td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">No orders yet.</p>
                        @endif
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
