<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class ReferralCode extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'class',
        'shift',
        'reff_code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Log Activity (Spatie)
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['class', 'shift', 'reff_code', 'is_active'])
            ->logOnlyDirty()
            ->useLogName('referral_codes')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Menambahkan Kode Referal',
                'updated' => 'Memperbarui Kode Referal',
                'deleted' => 'Menghapus Kode Referal',
                default => "Kode Referal {$eventName}",
            });
    }
}
