<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class AcademicInfo extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'photo',
        'description',
        'info_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Log Activity (Spatie)
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'photo', 'description', 'info_link', 'is_active'])
            ->logOnlyDirty()
            ->useLogName('academic_info')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Menambahkan Informasi Akademik',
                'updated' => 'Memperbarui Informasi Akademik',
                'deleted' => 'Menghapus Informasi Akademik',
                default => "Informasi Akademik {$eventName}",
            });
    }
}
