<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtracurricularPhoto extends Model
{
    protected $fillable = ['extracurricular_id', 'photos'];

    public function extracurricular()
    {
        return $this->belongsTo(Extracurricular::class);
    }
}
