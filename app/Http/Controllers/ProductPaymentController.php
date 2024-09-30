<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class ProductPaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans Config
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function getSnapToken(Request $request)
    {
        // Buat parameter transaksi berdasarkan produk yang dibeli
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $request->price, // Ambil harga produk dari request
            ],
            'customer_details' => [
                'first_name' => 'Customer',  // Bisa diganti dengan nama dari input
                'email' => 'customer@example.com',  // Bisa diganti dengan email dari input
                'phone' => '081234567890',  // Bisa diganti dengan nomor telepon dari input
            ],
            'item_details' => [
                [
                    'id' => $request->id,
                    'price' => $request->price,
                    'quantity' => 1,
                    'name' => $request->productName,
                ]
            ]
        ];

        // Dapatkan Snap Token dari Midtrans
        $snapToken = Snap::getSnapToken($params);

        return response()->json(['snap_token' => $snapToken]);
    }
}
