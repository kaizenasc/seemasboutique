<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $bestSellers = Product::where('is_featured', true)
            ->where('is_sold_out', false)
            ->with('category')
            ->latest()
            ->take(8)
            ->get();

        $newArrivals = Product::where('is_new_arrival', true)
            ->where('is_sold_out', false)
            ->with('category')
            ->latest()
            ->take(4)
            ->get();

        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->take(4)
            ->get();

        return view('home', compact('bestSellers', 'newArrivals', 'categories'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function privacyPolicy()
    {
        return view('policies.privacy');
    }

    public function refundPolicy()
    {
        return view('policies.refund');
    }

    public function termsConditions()
    {
        return view('policies.terms');
    }

    public function sizeChart()
    {
        return view('size-chart');
    }
}