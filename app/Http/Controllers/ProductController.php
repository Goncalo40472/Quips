<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'seller' => 'required',
        ]);

        $request->file('image')->store('public/images');

        $price = $request->get('price');
        $price = str_replace(',', '.', $price);

        $product = new Product([
            'name' => $request->get('name'),
            'price' => floatval($price),
            'description' => $request->get('description'),
            'category_id' => $request->get('category'),
            'image' => $request->file('image')->hashName(),
            'seller' => $request->get('seller'),
        ]);

        $product->save();
        $products = Product::where('seller', $product->seller)->get();
        $user = User::find($product->seller);
        return view('products.myProducts', compact('products', 'user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $category = Category::find($product->category_id);
        $seller = User::find($product->seller);
        $reviews = Review::where('product_id', $product->id)->get();
        $users = User::all();
        return view('products.show', compact('product', 'category', 'seller', 'reviews', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $reviews = Review::where('product_id', $product->id)->get();
        $reviews->each->delete();
        $product->delete();
        $products = Product::where('seller', $product->seller)->get();
        $user = User::find($product->seller);
        return view('products.myProducts', compact('products', 'user'));
    }

    public function myProducts(User $user)
    {
        $products = Product::where('seller', $user->id)->get();
        return view('products.myProducts', compact('products', 'user'));
    }
}
