<?php

namespace App\Http\Controllers;

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
        $timezones = array_diff(explode("\n", file_get_contents('helper/timezones')), ['']);
        $timezoneContinents = [];
        $timezoneTree = [];

        foreach ($timezones as $tz) {
            $continent = strtok($tz, '/');

            if (!in_array($continent, $timezoneContinents)) {
                $timezoneContinents[] = $continent;
            }

            if (isset($timezoneTree[$continent])) {
                $timezoneTree[$continent][] = strtok('/');
            } else {
                $timezoneTree[$continent] = [
                    strtok('/'),
                ];
            }
        }

        $currencies = getListOfCurrencies();

        return view('pages/setting/email', [
            'currencies' => $currencies,
            'timezoneTree' => $timezoneTree,
            'timezoneContinents' => $timezoneContinents,
        ]);
    }

    public function viewDatabase(): View {
        return view('pages/setting/database');
    }
}
