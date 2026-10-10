<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Greeting extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'teacher_id',
        'greeting_text',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    // log activity spatie
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['teacher_id', 'greeting_text', 'is_active'])
            ->logOnlyDirty()
            ->useLogName('greeting')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Menambahkan Sambutan Kepala Sekolah',
                'updated' => 'Memperbarui Sambutan Kepala Sekolah',
                'deleted' => 'Menghapus Sambutan Kepala Sekolah',
                default => "Sambutan {$eventName}",
            });
    }
}
