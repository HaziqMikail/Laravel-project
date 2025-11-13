@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>Welcome to E-Commerce Management System!</h4>
                    <p class="mb-4">Manage your products, customers, and orders efficiently.</p>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-center bg-primary text-white mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Products</h5>
                                    <p class="card-text fs-3">{{ \App\Models\Product::count() }}</p>
                                    <a href="{{ route('products.index') }}" class="btn btn-light">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center bg-success text-white mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Customers</h5>
                                    <p class="card-text fs-3">{{ \App\Models\Customer::count() }}</p>
                                    <a href="{{ route('customers.index') }}" class="btn btn-light">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center bg-info text-white mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Orders</h5>
                                    <p class="card-text fs-3">{{ \App\Models\Order::count() }}</p>
                                    <a href="{{ route('orders.index') }}" class="btn btn-light">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection