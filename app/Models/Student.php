<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Student extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nisn',
        'name',
        'mothers_name',
        'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nisn', 'name', 'mothers_name', 'is_active'])
            ->logOnlyDirty()
            ->useLogName('students')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Added New Data Student',
                'updated' => 'Updated Data Student',
                'deleted' => 'Deleted Data Student',
                default => "Student {$eventName}",
            });
    }
}
