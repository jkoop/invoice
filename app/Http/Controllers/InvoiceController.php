<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class InvoiceController extends Controller {
    public function list(): View {
        return view('pages/invoice/list');
    }
}
