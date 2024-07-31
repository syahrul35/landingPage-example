<?php

namespace App\Http\Controllers\PageContent;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::all();
        return Inertia::render('Backend/PageContent/Gallery/Gallery', [
            'galleries' => $galleries,
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
            'galleryImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'galleryTitle' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try{
            $path = null;
            if($request->hasFile('galleryImage')) {
                $path = $request->file('galleryImage')->store('gallery_images', 'public');
            }

            Gallery::create([
                'galleryImage' => $path,
                'title' => $validate['galleryTitle'],
                'description' => $validate['description'],
            ]);

            return redirect()->route('gallery.index')->with([
                'message' => [
                    'type' => 'success',
                    'message' => 'Gallery Created Successfully!'
                ]
            ]);
        } catch (\Exception $e) {
            return redirect()->route('gallery.index')->with([
                'message' => [
                    'type' => 'error',
                    'message' => 'Gallery Failed to Create!' . $e->getMessage()
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
    public function update(Request $request, Gallery $gallery)
    {
        $validate = $request->validate([
            'galleryImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'galleryTitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        // dd($validate);

        try {
            // Jika ada gambar baru, simpan dan hapus gambar lama
            if ($request->hasFile('galleryImage')) {
                if ($gallery->galleryImage && Storage::disk('public')->exists($gallery->galleryImage)) {
                    Storage::disk('public')->delete($gallery->galleryImage);
                }

                $path = $request->file('galleryImage')->store('gallery_images', 'public');
                $gallery->galleryImage = $path;
            }

            $gallery->title = $validate['galleryTitle'];
            $gallery->description = $validate['description'];
            $gallery->save();

            return redirect()->route('gallery.index')->with([
                'message' => [
                    'type' => 'success',
                    'message' => 'Gallery Updated Successfully!'
                ]
            ]);

        } catch (\Exception $e) {
            return redirect()->route('gallery.index')->with([
                'message' => [
                    'type' => 'error',
                    'message' => 'Gallery Failed to Update!' . $e->getMessage()
                ]
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        if (!$gallery) {
            return redirect()->route('gallery.index')->with('error', 'Gallery not found');
        }

        // Delete image
        if ($gallery->galleryImage) {
            Storage::disk('public')->delete($gallery->galleryImage);
        }

        $gallery->delete();

        return redirect()->route('gallery.index')->with([
            'message' => [
                'type' => 'success',
                'message' => 'Gallery Deleted Successfully!'
            ]
        ]);
    }
}
