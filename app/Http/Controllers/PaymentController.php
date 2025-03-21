<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function spp()
    {
        return view('payment.spp');
    }

    public function seragam()
    {
        return view('payment.seragam');
    }

    public function ijazah()
    {
        return view('payment.ijazah');
    }
}
