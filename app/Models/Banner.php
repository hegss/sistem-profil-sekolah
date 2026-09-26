<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Banner extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
    ];

    // relasi one-to-many ke galeri foto
    public function photos()
    {
        return $this->hasMany(BannerPhoto::class);
    }

    // Log Activity (Spatie)
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'subtitle', 'description'])
            ->logOnlyDirty()
            ->useLogName('banner')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Added New Banner',
                'updated' => 'Updated Data Banner',
                'deleted' => 'Deleted Data Banner',
                default => "Banner {$eventName}",
            });
    }
}
