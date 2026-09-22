<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description', 'short_description', 'category', 'features'];

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'category',
        'features',
        'icon',
        'is_featured',
        'order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'order' => 'integer',
    ];

    public function getFeaturesListAttribute(): array
    {
        $features = $this->getTranslation('features', app()->getLocale(), false);
        if (is_array($features)) {
            return $features;
        }
        if (is_string($features) && !empty($features)) {
            return array_filter(array_map('trim', explode("\n", $features)));
        }
        return [];
    }
}
