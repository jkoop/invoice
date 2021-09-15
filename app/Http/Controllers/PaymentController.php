<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PaymentController extends Controller {
    public function list(): View {
        return view('pages/payment/list');
    }
}
