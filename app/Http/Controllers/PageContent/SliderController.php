<?php

namespace App\Http\Controllers\PageContent;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Termwind\render;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Gallery::all();
        return Inertia::render('Backend/PageContent/Slider/Slider', [
            'sliders' => $sliders,
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
    public function update(Request $request, Gallery $slider)
    {
        try {
            $slider->isSlider = $request->isSlider;
            $slider->save();

            return redirect()->route('slider.index')->with('success', 'Slider Updated Successfully!');
        } catch (\Exception $e) {
            return redirect()->route('slider.index')->with('error', 'Failed to Update Slider!' . $e->getMessage());
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
