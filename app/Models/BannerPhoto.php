<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerPhoto extends Model
{
    protected $fillable = ['banner_id', 'photos'];

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }
}
