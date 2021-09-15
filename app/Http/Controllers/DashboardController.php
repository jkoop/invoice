<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class DashboardController extends Controller {
    public function view(): View {
        return view('pages/dashboard/view');
    }
}
