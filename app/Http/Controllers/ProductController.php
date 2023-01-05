<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Review;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            'name' => 'required|string|max:255',
            'price' => 'required',
            'description' => 'required|string|max:255',
            'category' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'seller' => 'required|integer',
        ]);

        $request->file('image')->store('public/images');

        $price = $request->get('price');
        $price = str_replace(' ', '', $price);
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
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'description' => 'required|string|max:255',
            'category' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'seller' => 'required|integer',
        ]);

        if($request->file('image') != null){
            $request->file('image')->store('public/images');
            if($product->image != 'product-image-placeholder.jpeg'){
                File::delete('storage/images/' . $product->image);
            }
            $product->image = $request->file('image')->hashName();
        }

        $price = $request->get('price');
        $price = str_replace(' ', '', $price);
        $price = str_replace(',', '.', $price);

        $product->name = $request->get('name');
        $product->price = floatval($price);
        $product->description = $request->get('description');
        $product->category_id = $request->get('category');
        $product->seller = $request->get('seller');

        $product->save();

        $products = Product::where('seller', $product->seller)->get();
        $user = User::find($product->seller);
        return redirect()->route('myProducts', compact('products', 'user'));
    
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

        $carts = Cart::where('product_id', $product->id)->get();
        $carts->each->delete();

        if($product->image != 'product-image-placeholder.jpeg'){
            File::delete('storage/images/' . $product->image);
        }

        $product->delete();

        $products = Product::where('seller', $product->seller)->get();
        $user = User::find($product->seller);
        
        return view('products.myProducts', compact('products', 'user'));
    }

    public function myProducts(User $user)
    {
        $products = Product::where('seller', $user->id)->paginate(10);
        return view('products.myProducts', compact('products', 'user'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $order = $request->get('order');

        if($order == 'priceAsc'){
            $products = Product::where('name', 'ilike', '%' . $search . '%')->orderBy('price', 'asc')->paginate(10);
        } 
        else if($order == 'priceDesc'){
            $products = Product::where('name', 'ilike', '%' . $search . '%')->orderBy('price', 'desc')->paginate(10);
        }
        else if($order == 'name'){
            $products = Product::where('name', 'ilike', '%' . $search . '%')->orderBy('name', 'asc')->paginate(10);
        }
        else if($order == 'dateAsc'){
            $products = Product::where('name', 'ilike', '%' . $search . '%')->orderBy('created_at', 'asc')->paginate(10);
        }
        else if($order == 'dateDesc'){
            $products = Product::where('name', 'ilike', '%' . $search . '%')->orderBy('created_at', 'desc')->paginate(10);
        }else{
            $products = Product::where('name', 'ilike', '%' . $search . '%')->paginate(10);
        }
        
        return view('products.index', compact('products', 'search', 'order'));
    }
}
