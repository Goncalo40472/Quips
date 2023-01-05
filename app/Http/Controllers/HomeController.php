<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::limit(4)->get();

        $products = array();

        foreach($categories as $category) {

            $products[$category->id] = Product::where('category_id', $category->id)->limit(4)->get();
            
        }

        return view('home', compact('products', 'categories'));
    }
}
