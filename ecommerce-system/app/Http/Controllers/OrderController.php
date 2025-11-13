<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::with(['customer', 'product'])->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::where('stock', '>', 0)->get();
        return view('orders.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->stock < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Not enough stock available.']);
        }

        $total_price = $product->price * $validated['quantity'];

        Order::create([
            'customer_id' => $validated['customer_id'],
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'total_price' => $total_price,
        ]);

        $product->decrement('stock', $validated['quantity']);

        return redirect()->route('orders.index')
            ->with('success', 'Order placed successfully.');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $order->product->increment('stock', $order->quantity);
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
