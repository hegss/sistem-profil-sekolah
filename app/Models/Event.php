<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Event extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'schedule',
        'description',
    ];

    // relasi one-to-many ke galeri foto
    public function photos()
    {
        return $this->hasMany(EventPhoto::class);
    }

    // Log Activity (Spatie)
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'schedule', 'description'])
            ->logOnlyDirty()
            ->useLogName('event')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Menambahkan Acara',
                'updated' => 'Memperbarui Data Acara',
                'deleted' => 'Menghapus Data Acara',
                default => "Acara {$eventName}",
            });
    }
}
