<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;


    public function progresses() {
        return $this->hasMany(Progress::class);
    }

    public function meals() {
        return $this->hasMany(ProgramMeal::class);
    }

    public function workouts() {
        return $this->hasMany(Workout::class);
    }

}
