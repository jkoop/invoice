<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
    use HasFactory;

    protected $table = 'settings';
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    /**
     * @param string $key key of setting
     * @return ?string value of setting or null
     */
    static function get(string $key): ?string {
        return Setting::find($key)->value ?? null;
    }
}
