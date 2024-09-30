<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\PageContent;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class LandingController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('isSlider', true)->get();
        $about = PageContent::find(1);
        $products = Product::all();

        return Inertia::render('Frontend/Landing', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'galleries' => $galleries,
            'about' => $about,
            'products' => $products,
        ]);
    }
}
