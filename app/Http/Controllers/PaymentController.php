<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment/index');
    }

    public function store(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
    
        /*$res = $stripe->tokens->create([
            'card' => [
              'number' => $request->card_number,
              'exp_month' => $request->month,
              'exp_year' => $request->year,
              'cvc' => $request->cvc,
        ],]);*/

        $res = $stripe->tokens->create([
            'card' => [
              'number' => '4242424242424242',
              'exp_month' => 12,
              'exp_year' => 2023,
              'cvc' => '314',
            ],
          ]);
    
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        $stripe->charges->create([
            'amount' => '1000',
            'currency' => 'eur',
            'source' => $res->id,
            'description' => 'My First Test Charge (created for API docs at https://www.stripe.com/docs/api)',
        ]);

        return redirect()->route('index')->with('success', 'Payment successful!');
    }
}
