<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use App\Models\Buy;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class MailController extends Controller
{
    public function sendEmail(Buy $buy) {

        $user = User::find($buy->user_id);
        $email = $user->email;
   
        $mailData = [
            'name' => $user->name,
            'total' => $buy->total,
        ];
  
        Mail::to($email)->send(new Email($mailData));
   
        return view('payment.success', ['buy' => $buy]);
    }
}
