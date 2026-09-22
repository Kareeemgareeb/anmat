<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        if (!$setting || $setting->value === null) {
            return $default;
        }

        // Try decoding JSON if applicable
        $json = json_decode($setting->value, true);
        if (json_last_error() === JSON_ERROR_NONE && (is_array($json) || is_object($json))) {
            return $json;
        }

        return $setting->value;
    }

    public static function set(string $key, $value, string $group = 'general'): self
    {
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        }

        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
    }

    public static function getLocalized(string $key, ?string $locale = null, $default = '')
    {
        $locale = $locale ?: app()->getLocale();
        $val = static::get($key);

        if (is_array($val)) {
            return $val[$locale] ?? $val['ar'] ?? $val['en'] ?? $default;
        }

        return $val ?? $default;
    }
}
