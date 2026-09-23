<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Teacher extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name',
        'photo',
        'position',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Konfigurasi Spatie Activity Log
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'position', 'is_active']) // Kolom yang dipantau
            ->logOnlyDirty() // Hanya catat jika ada data yang berubah
            ->useLogName('teacher') // Label log
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Added Data Teacher',
                'updated' => 'Updated Data Teacher',
                'deleted' => 'Deleted Data Teacher',
                default => "Teacher {$eventName}",
            });
    }
}
