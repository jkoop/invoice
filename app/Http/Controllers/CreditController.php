<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class CreditController extends Controller {
    public function list(): View {
        return view('pages/credit/list');
    }
}
