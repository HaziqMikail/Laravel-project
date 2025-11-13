@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Order Details</span>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-sm">Back</a>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Order Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th>Order ID:</th>
                                    <td>#{{ $order->id }}</td>
                                </tr>
                                <tr>
                                    <th>Order Date:</th>
                                    <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Customer Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $order->customer->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $order->customer->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $order->customer->phone }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <h5>Order Items</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $order->product->name }}</td>
                                <td>${{ number_format($order->product->price, 2) }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ number_format($order->total_price, 2) }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total:</th>
                                <th>${{ number_format($order->total_price, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="mt-3">
                        <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this order?')">Cancel Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection