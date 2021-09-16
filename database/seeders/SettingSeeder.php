<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        static $settings = [
            // key, value
            ['my_email', ''],
            ['my_phone', ''],
            ['my_name', ''],
            ['company_name', ''],
            ['address', ''],
            ['address_2', ''],
            ['city', ''],
            ['province', ''],
            ['postal_code', ''],
            ['country', ''],
            ['default_currency_code', 'CAD'],
            ['default_currency_display', 'symbol'],
            ['thousands_separator', 'comma'],
            ['decimal_separator', 'period'],
            ['thousandths_separator', 'none'],
            ['date_format', 'Y M d H:i'],
            ['timezone', 'America/Winnipeg'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->insert([
                'key' => $setting[0],
                'value' => $setting[1],
            ]);
        }
    }
}
