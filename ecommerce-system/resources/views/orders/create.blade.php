@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Place New Order</div>

                <div class="card-body">
                    @if($customers->count() == 0 || $products->count() == 0)
                        <div class="alert alert-warning">
                            @if($customers->count() == 0)
                                <p>No customers available. <a href="{{ route('customers.create') }}">Add a customer first</a>.</p>
                            @endif
                            @if($products->count() == 0)
                                <p>No products in stock. <a href="{{ route('products.create') }}">Add a product first</a>.</p>
                            @endif
                        </div>
                    @else
                        <form method="POST" action="{{ route('orders.store') }}" id="orderForm">
                            @csrf

                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Select Customer *</label>
                                <select class="form-select @error('customer_id') is-invalid @enderror" 
                                        id="customer_id" name="customer_id" required>
                                    <option value="">Choose a customer...</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }} ({{ $customer->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="product_id" class="form-label">Select Product *</label>
                                <select class="form-select @error('product_id') is-invalid @enderror" 
                                        id="product_id" name="product_id" required>
                                    <option value="">Choose a product...</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" 
                                                data-price="{{ $product->price }}" 
                                                data-stock="{{ $product->stock }}"
                                                {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }} - ${{ number_format($product->price, 2) }} (Stock: {{ $product->stock }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity *</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                       id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="1" required>
                                <small id="stockInfo" class="form-text text-muted"></small>
                                @error('quantity')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Estimated Total:</label>
                                <h4 id="totalPrice">$0.00</h4>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Place Order</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productSelect = document.getElementById('product_id');
    const quantityInput = document.getElementById('quantity');
    const totalPrice = document.getElementById('totalPrice');
    const stockInfo = document.getElementById('stockInfo');

    function updatePrice() {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const price = parseFloat(selectedOption.dataset.price || 0);
        const stock = parseInt(selectedOption.dataset.stock || 0);
        const quantity = parseInt(quantityInput.value || 0);

        if (price && quantity) {
            totalPrice.textContent = '$' + (price * quantity).toFixed(2);
            stockInfo.textContent = `Available stock: ${stock} units`;
            
            if (quantity > stock) {
                stockInfo.classList.add('text-danger');
                stockInfo.textContent = `Warning: Only ${stock} units available!`;
            } else {
                stockInfo.classList.remove('text-danger');
            }
        } else {
            totalPrice.textContent = '$0.00';
            stockInfo.textContent = '';
        }
    }

    productSelect.addEventListener('change', updatePrice);
    quantityInput.addEventListener('input', updatePrice);
    
    updatePrice();
});
</script>
@endsection
