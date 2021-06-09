<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutAreaMove extends Model
{
    use HasFactory;


    public function workout_areas()
    {
        return $this->belongsToMany(WorkoutArea::class);
    }

    public function moves()
    {
        return $this->hasOne(Move::class);
    }
}
