<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Setting;
use App\Models\Timezone;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse as Redirection;

class SettingController extends Controller {
    public function list(): View {
        return view('pages/setting/list');
    }

    public function viewContactInfo(): View {
        return view('pages/setting/contactInfo', [
            'myEmail' => Setting::get('my_email'),
            'myPhone' => Setting::get('my_phone'),
            'myName' => Setting::get('my_name'),
            'companyName' => Setting::get('company_name'),
            'address' => Setting::get('address'),
            'address2' => Setting::get('address_2'),
            'city' => Setting::get('city'),
            'province' => Setting::get('province'),
            'postalCode' => Setting::get('postal_code'),
            'country' => Setting::get('country'),
        ]);
    }

    public function updateContactInfo(): Redirection {
        static $settingPairs = [
            // db key, request key
            ['my_email', 'my-email'],
            ['my_phone', 'my-phone'],
            ['my_name', 'my-name'],
            ['company_name', 'company-name'],
            ['address', 'address'],
            ['address_2', 'address-2'],
            ['city', 'city'],
            ['province', 'province'],
            ['postal_code', 'postal-code'],
            ['country', 'country'],
        ];

        foreach ($settingPairs as $pair) {
            $s = Setting::find($pair[0]); // db key
            $s->value = request($pair[1], ''); // request key
            $s->save();
        }

        setMessage('Successfully set contact info', 'success');

        return back();
    }

    public function viewEmail(): View {
        return view('pages/setting/email');
    }

    public function viewLocale(): View {
        return view('pages/setting/locale', [
            'currencies' => Currency::all(),
            'currenciesByCode' => Currency::allByCode(),
            'timezoneContinents' => Timezone::getContinents(),
            'timezoneTree' => Timezone::getTimezoneTree(),

            'defaultCurrencyCode' => Setting::get('default_currency_code'),
            'defaultCurrencyDisplay' => Setting::get('default_currency_display'),
            'thousandsSeparator' => Setting::get('thousands_separator'),
            'decimalSeparator' => Setting::get('decimal_separator'),
            'thousandthsSeparator' => Setting::get('thousandths_separator'),
            'dateFormat' => Setting::get('date_format'),
            'timezoneContinent' => strtok(Setting::get('timezone'), '/'),
            'timezoneCity' => explode('/', Setting::get('timezone'))[1],
        ]);
    }

    public function updateLocale(): Redirection {
        static $settingPairs = [
            // db key, request key
            ['default_currency_code', 'default-currency-code'],
            ['default_currency_display', 'default-currency-display'],
            ['thousands_separator', 'thousands-separator'],
            ['decimal_separator', 'decimal-separator'],
            ['thousandths_separator', 'thousandths-separator'],
            ['date_format', 'date-format'],
        ];

        foreach ($settingPairs as $pair) {
            $s = Setting::find($pair[0]); // db key
            $s->value = request($pair[1]); // request key
            $s->save();
        }

        $s = Setting::find('timezone');
        $s->value = request('timezone-continent') . '/'. request('timezone-city');
        $s->save();

        setMessage('Successfully set locale settings', 'success');

        return back();
    }

    public function viewDatabase(): View {
        return view('pages/setting/database');
    }
}
