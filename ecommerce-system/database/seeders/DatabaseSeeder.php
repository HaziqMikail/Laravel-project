<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@ecommerce.com',
            'password' => Hash::make('password123'),
        ]);

        // Create Sample Products
        $products = [
            [
                'name' => 'Laptop Dell XPS 15',
                'description' => 'High-performance laptop with Intel i7 processor, 16GB RAM, and 512GB SSD. Perfect for professionals and students.',
                'price' => 1299.99,
                'stock' => 25
            ],
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'Latest Apple iPhone with A17 Pro chip, advanced camera system, and titanium design.',
                'price' => 999.99,
                'stock' => 50
            ],
            [
                'name' => 'Samsung 4K Smart TV 55"',
                'description' => '55-inch 4K UHD Smart TV with HDR, built-in streaming apps, and voice control.',
                'price' => 699.99,
                'stock' => 15
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'description' => 'Industry-leading noise cancellation with premium sound quality and 30-hour battery life.',
                'price' => 349.99,
                'stock' => 40
            ],
            [
                'name' => 'iPad Air 5th Gen',
                'description' => '10.9-inch Liquid Retina display, M1 chip, works with Apple Pencil and Magic Keyboard.',
                'price' => 599.99,
                'stock' => 30
            ],
            [
                'name' => 'Logitech MX Master 3S Mouse',
                'description' => 'Advanced wireless mouse with ergonomic design, customizable buttons, and precision tracking.',
                'price' => 99.99,
                'stock' => 60
            ],
            [
                'name' => 'Nintendo Switch OLED',
                'description' => 'Gaming console with vibrant 7-inch OLED screen, enhanced audio, and adjustable stand.',
                'price' => 349.99,
                'stock' => 20
            ],
            [
                'name' => 'Canon EOS R6 Camera',
                'description' => 'Professional mirrorless camera with 20MP full-frame sensor and 4K video recording.',
                'price' => 2499.99,
                'stock' => 8
            ],
            [
                'name' => 'Kindle Paperwhite',
                'description' => 'Waterproof e-reader with 6.8" display, adjustable warm light, and weeks of battery life.',
                'price' => 139.99,
                'stock' => 45
            ],
            [
                'name' => 'Dyson V15 Vacuum',
                'description' => 'Cordless vacuum with laser detection, HEPA filtration, and intelligent cleaning modes.',
                'price' => 649.99,
                'stock' => 12
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Create Sample Customers
        $customers = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone' => '+1-555-0123',
                'address' => '123 Main Street, New York, NY 10001'
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '+1-555-0124',
                'address' => '456 Oak Avenue, Los Angeles, CA 90001'
            ],
            [
                'name' => 'Michael Johnson',
                'email' => 'michael.j@example.com',
                'phone' => '+1-555-0125',
                'address' => '789 Pine Road, Chicago, IL 60601'
            ],
            [
                'name' => 'Emily Brown',
                'email' => 'emily.brown@example.com',
                'phone' => '+1-555-0126',
                'address' => '321 Elm Street, Houston, TX 77001'
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david.wilson@example.com',
                'phone' => '+1-555-0127',
                'address' => '654 Maple Drive, Phoenix, AZ 85001'
            ]
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }

        // Create Sample Orders
        Order::create([
            'customer_id' => 1,
            'product_id' => 2,
            'quantity' => 1,
            'total_price' => 999.99
        ]);

        Order::create([
            'customer_id' => 2,
            'product_id' => 4,
            'quantity' => 2,
            'total_price' => 699.98
        ]);

        Order::create([
            'customer_id' => 3,
            'product_id' => 1,
            'quantity' => 1,
            'total_price' => 1299.99
        ]);
    }
}
