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

    public function removeProduct(Product $product)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
        $cart->delete();

        return redirect()->route('cart');
    }

    public function addProduct(Request $request, Product $product)
    {
        Request()->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $cart = new Cart();
        $cart->user_id = auth()->user()->id;
        $cart->product_id = $product->id;
        
        if($request->quantity <= $product->stock) {
            $cart->quantity = $request->quantity;
        } else {
            $cart->quantity = $product->stock;
        }

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

        return view('payment.checkout', ['price' => $price, 'type' => 'cart']);
    }

    public function productQuantity(Request $request, Product $product)
    {
        Request()->validate([
            'quantity' => 'required|numeric|min:1'
        ]);

        if($request->quantity <= $product->stock) {

            $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
            $cart->quantity = $request->quantity;
            $cart->price = $product->price * $request->quantity;
            $cart->save();

        }else {

            $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
            $cart->quantity = $product->stock;
            $cart->price = $product->price * $product->stock;
            $cart->save();
            
        }

        return redirect()->route('cart');
    }

}
