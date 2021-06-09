<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutDay extends Model
{
    use HasFactory;

    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }

    public function workout()
    {
        return $this->hasOne(Workout::class);
    }
}
