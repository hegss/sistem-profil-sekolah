<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Complaint extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'referral_code',
        'sender_name',
        'sender_phone',
        'category',
        'message',
        'status',
    ];

    // Log Activity (Spatie)
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status'])
            ->logOnlyDirty()
            ->useLogName('complaint')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'updated' => 'Memperbarui Status Keluhan',
                'deleted' => 'Menghapus Pesan Keluhan',
                default => "Keluhan {$eventName}",
            });
    }
}
