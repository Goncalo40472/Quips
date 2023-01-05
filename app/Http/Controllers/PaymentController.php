<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Buy;
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
        return view('payment.checkout', ['price' => $product->price]);
    }

    public function payment(Request $request)
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
            
            return view('payment.success', ['buy' => $buy]);
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
