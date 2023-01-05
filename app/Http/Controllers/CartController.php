<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        
        foreach($cart as $item) {
            $item->product = Product::where('id', $item->product_id)->first();
        }

        return view('cart.index', ['cart' => $cart]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function removeProduct(Product $product)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
        $cart->delete();

        return redirect()->route('cart');
    }

    public function addProduct(Request $request, Product $product)
    {
        Request()->validate([
            'quantity' => 'required|numeric|min:1|max:10',
        ]);

        $cart = new Cart();
        $cart->user_id = auth()->user()->id;
        $cart->product_id = $product->id;
        $cart->quantity = $request->quantity;
        $cart->price = $product->price * $request->quantity;
        $cart->save();

        return redirect()->route('cart');
    }

    public function checkout()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->get();

        $price = 0;
        
        foreach($cart as $item) {
            $item->product = Product::where('id', $item->product_id)->first();
            $price += $item->product->price * $item->quantity;
        }

        return view('payment.checkout', ['price' => $price]);
    }

    public function productQuantity(Request $request, Product $product)
    {
        Request()->validate([
            'quantity' => 'required|numeric|min:1|max:10'
        ]);

        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
        $cart->quantity = $request->quantity;
        $cart->price = $product->price * $request->quantity;
        $cart->save();

        return redirect()->route('cart');
    }

}
