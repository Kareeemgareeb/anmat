<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description', 'client', 'location', 'category'];

    protected $fillable = [
        'title',
        'description',
        'client',
        'location',
        'category',
        'area',
        'status',
        'is_featured',
        'order',
        'image_path',
        'completion_date',
    ];

    protected $casts = [
        'completion_date' => 'date',
        'is_featured' => 'boolean',
        'order' => 'integer',
    ];

    public function getImageUrlAttribute(): string
    {
        if ($this->image_path) {
            if (str_starts_with($this->image_path, 'http') || str_starts_with($this->image_path, '/')) {
                return $this->image_path;
            }
            return Storage::disk('public')->url($this->image_path);
        }
        return asset('images/project-placeholder.jpg');
    }

    public function getStatusLabelAttribute(): string
    {
        $locale = app()->getLocale();
        return match ($this->status) {
            'completed' => $locale === 'ar' ? 'مكتمل' : 'Completed',
            'ongoing' => $locale === 'ar' ? 'قيد التنفيذ' : 'In Progress',
            'planning' => $locale === 'ar' ? 'مرحلة التخطيط والدراسة' : 'Planning & Study',
            default => ucfirst($this->status),
        };
    }
}
