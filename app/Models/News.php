<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class News extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'news';

    protected $fillable = [
        'photo',
        'title',
        'publish_date',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'publish_date' => 'date',
    ];

    // Log Activity (Spatie)
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'publish_date', 'description', 'is_active'])
            ->logOnlyDirty()
            ->useLogName('news')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Menambahkan Berita',
                'updated' => 'Memperbarui Berita',
                'deleted' => 'Menghapus Berita',
                default => "Berita {$eventName}",
            });
    }
}
