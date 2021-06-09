<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;


    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function days()
    {
        return $this->hasMany(WorkoutDay::class);
    }
}
