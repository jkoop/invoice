<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Timezone;
use Illuminate\Contracts\View\View;

class SettingController extends Controller {
    public function list(): View {
        return view('pages/setting/list');
    }

    public function viewMyAddress(): View {
        return view('pages/setting/myAddress');
    }

    public function viewEmail(): View {
        return view('pages/setting/email');
    }

    public function viewLocale(): View {
        return view('pages/setting/locale');
    }

    public function viewDatabase(): View {
        return view('pages/setting/database');
    }
}
