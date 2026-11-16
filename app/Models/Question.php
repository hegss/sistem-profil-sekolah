<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Support\LogOptions;

class Question extends Model
{
    protected $fillable = [
        'question_text',
        'answer_text',
        'is_active',
    ];

    // Log Activity (Spatie)
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['is_active'])
            ->logOnlyDirty()
            ->useLogName('faq')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Menambahkan Template FAQ Baru',
                'updated' => 'Memperbarui Template FAQ',
                'deleted' => 'Menghapus Template FAQ',
                default => "FAQ {$eventName}",
            });
    }
}
