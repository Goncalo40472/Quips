<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buy;
use PDF;

class ReceiptController extends Controller
{
    public function generateReceipt(Buy $buy)
    {
        $data = [
            'buy' => $buy,
            'products' => $buy->products,
        ];
        
        $pdf = PDF::loadView('receipt.receiptPDF', $data);

        return $pdf->download('Fatura.pdf');
    }
}
