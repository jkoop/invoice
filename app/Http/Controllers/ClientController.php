<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\View\View;

class ClientController extends Controller {
    public function list(): View {
        $clients = Client::all();

        return view('pages/client/list', [
            'clients' => $clients,
        ]);
    }
}
