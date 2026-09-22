<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Correspondence extends Model
{
    protected $fillable = [
        'reference_number',
        'type',
        'subject',
        'sender',
        'receiver',
        'date_issued',
        'file_path',
        'file_name',
        'file_size',
        'status',
        'priority',
        'physical_location',
        'tags',
        'notes',
    ];

    protected $casts = [
        'date_issued' => 'date',
        'file_size' => 'integer',
    ];

    public static function generateNextReference(string $type = 'outgoing'): string
    {
        $prefix = match ($type) {
            'incoming' => 'ANMAT-IN',
            'outgoing' => 'ANMAT-OUT',
            'internal' => 'ANMAT-INT',
            'technical_report' => 'ANMAT-REP',
            'contract_drawing' => 'ANMAT-CTR',
            default => 'ANMAT-DOC',
        };

        $year = date('Y');
        $searchPrefix = "{$prefix}-{$year}-";

        $latest = static::where('reference_number', 'LIKE', "{$searchPrefix}%")
            ->orderBy('id', 'desc')
            ->first();

        $sequence = 1;
        if ($latest && preg_match('/-(\d+)$/', $latest->reference_number, $matches)) {
            $sequence = intval($matches[1]) + 1;
        }

        return sprintf('%s-%s-%04d', $prefix, $year, $sequence);
    }

    public function getTypeLabelAttribute(): string
    {
        $locale = app()->getLocale();
        return match ($this->type) {
            'outgoing' => $locale === 'ar' ? 'صادر رسمي' : 'Outgoing Letter',
            'incoming' => $locale === 'ar' ? 'وارد رسمي' : 'Incoming Letter',
            'internal' => $locale === 'ar' ? 'مذكرة داخلية' : 'Internal Memo',
            'technical_report' => $locale === 'ar' ? 'تقرير فني / هندسي' : 'Technical Report',
            'contract_drawing' => $locale === 'ar' ? 'عقد / مخططات' : 'Contract & Drawings',
            default => ucfirst(str_replace('_', ' ', $this->type)),
        };
    }

    public function getPriorityLabelAttribute(): string
    {
        $locale = app()->getLocale();
        return match ($this->priority) {
            'urgent' => $locale === 'ar' ? 'عاجل' : 'Urgent',
            'top_secret' => $locale === 'ar' ? 'سري وعاجل' : 'Confidential',
            default => $locale === 'ar' ? 'عادي' : 'Normal',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        $locale = app()->getLocale();
        return match ($this->status) {
            'pending_action' => $locale === 'ar' ? 'قيد المتابعة' : 'Pending Action',
            'closed' => $locale === 'ar' ? 'مكتمل' : 'Completed',
            'archived' => $locale === 'ar' ? 'مؤرشف نهائياً' : 'Archived',
            default => ucfirst(str_replace('_', ' ', $this->status)),
        };
    }

    public function getFormattedFileSizeAttribute(): string
    {
        if (!$this->file_size) return '-';
        if ($this->file_size < 1024) return $this->file_size . ' B';
        if ($this->file_size < 1048576) return round($this->file_size / 1024, 1) . ' KB';
        return round($this->file_size / 1048576, 2) . ' MB';
    }
}
