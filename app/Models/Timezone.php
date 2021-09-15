<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timezone extends Model {
    use HasFactory;

    protected $table = 'timezones';
    protected $primaryKey = 'name';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    /**
     * @return array of timezone continents
     */
    static function getContinents(): array {
        $timezones = Timezone::all();
        $continents = [];

        foreach ($timezones as $timezone) {
            $continent = strtok($timezone->name, '/');

            if (!in_array($continent, $continents)) {
                $continents[] = $continent;
            }
        }

        return $continents;
    }

    /**
     * @return array associative array of indexed arrays; key is continent, values are cities
     */
    static function getTimezoneTree(): array {
        $timezones = Timezone::all();
        $tree = [];

        foreach ($timezones as $timezone) {
            $continent = strtok($timezone->name, '/');

            if (isset($tree[$continent])) {
                $tree[$continent][] = strtok('/');
            } else {
                $tree[$continent] = [
                    strtok('/'),
                ];
            }
        }

        return $tree;
    }
}
