<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPhoto extends Model
{
    protected $fillable = [
        'event_id',
        'photos',
    ];

    // relasi many-to-one ke event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
