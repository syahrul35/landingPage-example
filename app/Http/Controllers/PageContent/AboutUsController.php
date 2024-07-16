<?php

namespace App\Http\Controllers\PageContent;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageContent = PageContent::find(1);
        return Inertia::render('Backend/PageContent/AboutUs/AboutUs', [
            'pageContent' => $pageContent,
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
        //
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
    public function update(Request $request, PageContent $aboutu)
    {
        // Validasi input
        $validate = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'maps' => 'required|string',
        ]);

        try {
            // Handle upload logo jika ada
            if ($request->hasFile('logo')) {
                // Hapus logo lama jika ada
                if ($aboutu->logo && Storage::disk('public')->exists($aboutu->logo)){
                    Storage::disk('public')->delete($aboutu->logo);
                }

                // Simpan logo baru
                $path = $request->file('logo')->store('logo', 'public');
                $aboutu->logo = $path;
            }

            // Update data lainnya
            $aboutu->about = $validate['about'];
            $aboutu->email = $validate['email'];
            $aboutu->phone = $validate['phone'];
            $aboutu->address = $validate['address'];
            $aboutu->maps = $validate['maps'];
            
            // Simpan perubahan
            $aboutu->save();

            // Redirect atau response sesuai kebutuhan
            return redirect()->with('success', 'Page Content updated successfully!');

        } catch (\Exception $e) {
            return redirect()->route('aboutus.index')->with('error', 'Failed to update Page Content! ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
