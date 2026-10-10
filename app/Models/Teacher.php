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

    public function greeting()
    {
        return $this->hasOne(Greeting::class);
    }

    // Konfigurasi Spatie Activity Log
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'position', 'is_active']) // Kolom yang dipantau
            ->logOnlyDirty() // Hanya catat jika ada data yang berubah
            ->useLogName('teacher') // Label log
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Menambahkan Data Guru',
                'updated' => 'Memperbarui Data Guru',
                'deleted' => 'Menghapus Data Guru',
                default => "Guru {$eventName}",
            });
    }
}
