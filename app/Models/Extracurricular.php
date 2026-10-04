<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Extracurricular extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'logo',
        'schedule',
        'description',
    ];

    // relasi one-to-many ke galeri foto
    public function photos()
    {
        return $this->hasMany(ExtracurricularPhoto::class);
    }

    // Log Activity (Spatie)
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'logo', 'schedule', 'description'])
            ->logOnlyDirty()
            ->useLogName('extracurricular')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Menambahkan Ekstrakurikuler',
                'updated' => 'Memperbarui Data Ekstrakurikuler',
                'deleted' => 'Menghapus Data Ekstrakurikuler',
                default => "Ekstrakurikuler {$eventName}",
            });
    }
}
