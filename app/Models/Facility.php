<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Facility extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'location',
        'description',
    ];

    // relasi on-to-many ke facility_photo
    public function photos()
    {
        return $this->hasMany(FacilityPhoto::class);
    }

    // log activity spatie
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'location'])
            ->logOnlyDirty()
            ->useLogName('facility')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Menambahkan Fasilitas Baru',
                'updated' => 'Memperbarui Data Fasilitas',
                'deleted' => 'Menghapus Data Fasilitas',
                default => "Fasilitas {$eventName}",
            });
    }
}
