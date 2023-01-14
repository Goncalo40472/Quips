<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Buy;
use App\Models\Cart;
use App\Models\Review;
use App\Models\ProductsBuy;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;

class PaymentController extends Controller
{   
    private $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
    }

    public function checkout(Product $product)
    {
        return view('payment.checkout', ['price' => $product->price, 'product' => $product, 'type' => 'product']);
    }

    public function paymentProduct(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'cardNumber' => 'required',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('danger', $validator->errors()->first());
            return response()->redirectTo('/');
        }

        $token = $this->createToken($request);

        if (!empty($token['error'])) {
            return response()->redirectTo('/');
        }
        if (empty($token['id'])) {
            return response()->redirectTo('/');
        }

        $charge = $this->createCharge($token['id'], $request->price * 100);

        if (!empty($charge) && $charge['status'] == 'succeeded') {

            $buy = new Buy();
            $buy->user_id = auth()->user()->id;
            $buy->total = $request->price;
            $buy->save();

            $productsBuy = new ProductsBuy();
            $productsBuy->buy_id = $buy->id;
            $productsBuy->product_id = $product->id;
            $productsBuy->quantity = 1;
            $productsBuy->total = $product->price;
            $productsBuy->save();

            if($product->stock - 1 == 0) {

                $reviews = Review::where('product_id', $product->id)->get();
                $reviews->each->delete();

                $carts = Cart::where('product_id', $product->id)->get();
                $carts->each->delete();

                if($product->image != 'product-image-placeholder.jpeg'){
                    File::delete('storage/images/' . $product->image);
                }

                $productsBuy = ProductsBuy::where('product_id', $product->id)->get();
                $productsBuy->each->delete();

                $product->delete();

            }else {

                $product->stock = $product->stock - 1;
                $product->save();

            }

            return redirect()->route('emailReceipt', ['buy' => $buy]);
        }
        return response()->redirectTo('/');
    }

    public function paymentCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'cardNumber' => 'required',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('danger', $validator->errors()->first());
            return response()->redirectTo('/');
        }

        $token = $this->createToken($request);

        if (!empty($token['error'])) {
            return response()->redirectTo('/');
        }
        if (empty($token['id'])) {
            return response()->redirectTo('/');
        }

        $charge = $this->createCharge($token['id'], $request->price * 100);

        if (!empty($charge) && $charge['status'] == 'succeeded') {

            $buy = new Buy();
            $buy->user_id = auth()->user()->id;
            $buy->total = $request->price;
            $buy->save();

            $carts = Cart::where('user_id', auth()->user()->id)->get();

            foreach ($carts as $cart) {
                $productsBuy = new ProductsBuy();
                $productsBuy->buy_id = $buy->id;
                $productsBuy->product_id = $cart->product_id;
                $productsBuy->quantity = $cart->quantity;
                $productsBuy->total = $cart->price;
                $productsBuy->save();

                $product = Product::find($cart->product_id);

                if($product->stock - 1 == 0) {

                    $reviews = Review::where('product_id', $product->id)->get();
                    $reviews->each->delete();

                    $carts = Cart::where('product_id', $product->id)->get();
                    $carts->each->delete();

                    if($product->image != 'product-image-placeholder.jpeg'){
                        File::delete('storage/images/' . $product->image);
                    }

                    $productsBuy = ProductsBuy::where('product_id', $product->id)->get();
                    $productsBuy->each->delete();

                    $product->delete();

                }else {

                    $product->stock = $product->stock - 1;
                    $product->save();

                }
            }
            
            return redirect()->route('emailReceipt', ['buy' => $buy]);
        }
        return response()->redirectTo('/');
    }

    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount)
    {
        $charge = null;
        try {
            $charge = $this->stripe->charges->create([
                'amount' => $amount,
                'currency' => 'eur',
                'source' => $tokenId,
                'description' => 'My first payment'
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }
}
