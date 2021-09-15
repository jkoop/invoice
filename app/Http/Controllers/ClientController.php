<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ClientController extends Controller {
    public function list(): View {
        return view('pages/client/list');
    }
}
