<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Midtrans\Config;
use Midtrans\Snap;

class ProductPaymentController extends Controller
{
    public function getSnapToken(Request $request)
    {
        // Menggunakan serverKey dan konfigurasi yang benar dari config/services.php
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey'); 
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction'); 
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $product = Product::find($request->input('product_id'));
        
        // Validasi product
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Hitung total harga
        $totalAmount = $product->price;  // Total price of the product

        $transaction_details = [
            'order_id' => 'ORDER-' . uniqid(),
            'gross_amount' => $totalAmount, // Total price
        ];

        // Berikan detail item
        $item_details = [
            [
                'id' => $product->id,
                'price' => $product->price,
                'quantity' => 1,
                'name' => $product->productName ?: 'Unknown Product', // Pastikan nama produk tidak kosong
            ]
        ];

        // Buat parameter transaksi
        $transaction = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => $request->input('name'),
                'email' => $request->input('email'),
                'redirect_url' => 'https://syahrul35.github.io/payment-template/'
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($transaction);
            return Inertia::render('Frontend/ProductDetail', [
                'snap_token' => $snapToken,
                'product' => $product,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
