<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return Inertia::render('Backend/Products/Category/Category', [
            'categories' => $categories
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
        $request->validate([
            'categoryName' => 'required|string|max:255',
        ]);

        try {
            Category::create($request->all());

            return redirect()->route('category.index')->with([
                'message' => [
                    'type' => 'success',
                    'message' => 'Category Created Successfully!'
                ]
            ]);
        } catch (\Exception $e) {
            return redirect()->route('category.index')->with([
                'message' => [
                    'type' => 'error',
                    'message' => 'Category Failed to Created!' . $e->getMessage()
                ]
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'categoryName' => 'required|string|max:255',
        ]);

        try {
            $category->update($request->all());
    
            return redirect()->route('category.index')->with([
                'message' => [
                    'type' => 'success',
                    'message' => 'Category Updated Successfully!'
                ]
            ]);
        } catch (\Exception $e) {
            return redirect()->route('category.index')->with([
                'message' => [
                    'type' => 'error',
                    'message' => 'Category Failed to Updated!' . $e->getMessage()
                ]
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with([
            'message' => [
                'type' => 'success',
                'message' => 'Category Deleted Successfully!'
            ]
        ]);
    }
}
