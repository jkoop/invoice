<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model {
    use HasFactory;

    protected $table = 'currencies';
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    /**
     * @return object of objects; key is currency code, values are description and symbol
     */
    static function allByCode(): object {
        $currencies = Currency::all();
        $listByCode = [];

        foreach ($currencies as $currency) {
            $listByCode[$currency->code] = (object) [
                'description' => $currency->description,
                'symbol' => $currency->symbol,
            ];
        }

        return (object) $listByCode;
    }
}
