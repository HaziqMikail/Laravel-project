@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Product Details</span>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">Back</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">ID:</th>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $product->description }}</td>
                        </tr>
                        <tr>
                            <th>Price:</th>
                            <td>${{ number_format($product->price, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Stock:</th>
                            <td>
                                <span class="badge bg-{{ $product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning' : 'danger') }}">
                                    {{ $product->stock }} units
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $product->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At:</th>
                            <td>{{ $product->updated_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>

                    <div class="mt-3">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
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