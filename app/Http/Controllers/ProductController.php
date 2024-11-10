<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PageContent;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        return Inertia::render('Backend/Products/Products/Products', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'idCategory' => 'required|exists:categories,id',
            'productName' => 'required|string|max:255',
            'productImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);
        
        try{
            $path = null;
            if ($request->hasFile('productImage')) {
                $path = $request->file('productImage')->store('product_images', 'public');
            }

            Product::create([
                'idCategory' => $validate['idCategory'],
                'productName' => $validate['productName'],
                'productImage' => $path,
                'description' => $validate['description'],
                'price' => $validate['price'],
            ]);

            return redirect()->route('products.index')->with([
                'message' => [
                    'type' => 'success',
                    'message' => 'Product Created Successfully!'
                ]
            ]);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with([
                'message' => [
                    'type' => 'error',
                    'message' => 'Product Failed to Created!' . $e->getMessage()
                ]
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $about = PageContent::find(1);
        $product = Product::findOrFail($id);

        // Kirim produk ke halaman detail produk menggunakan Inertia
        return Inertia::render('Backend/Products/Products/ProductDetail', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validate = $request->validate([
            'idCategory' => 'nullable|exists:categories,id',
            'productName' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
        ]);

        // Cek apakah ada perubahan pada gambar produk
        if ($request->hasFile('productImage')) {
            $request->validate([
                'productImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        }
        // dd($request->hasFile('productImage'));

        try {
            $product = Product::findOrFail($product->id);

            $product->idCategory = $validate['idCategory'];
            $product->productName = $validate['productName'];
            $product->description = $validate['description'];
            $product->price = $validate['price'];

            // Update gambar hanya jika ada perubahan
            if ($request->hasFile('productImage')) {
                // Hapus gambar lama jika ada
                if ($product->productImage && Storage::disk('public')->exists($product->productImage)) {
                    Storage::disk('public')->delete($product->productImage);
                }

                // Simpan gambar baru
                $path = $request->file('productImage')->store('product_images', 'public');
                $product->productImage = $path;
            }

            $product->save();

            return redirect()->route('products.index')->with([
                'message' => [
                    'type' => 'success',
                    'message' => 'Product Updated Successfully!'
                ]
            ]);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with([
                'message' => [
                    'type' => 'success',
                    'message' => 'Product Failed to Update!' . $e->getMessage()
                ]
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found');
        }

        // Delete image
        if ($product->productImage) {
            Storage::disk('public')->delete($product->productImage);
        }

        $product->delete();

        return redirect()->route('products.index')->with([
            'message' => [
                    'type' => 'success',
                    'message' => 'Product Deleted Successfully!'
                ]
        ]);
    }
}
