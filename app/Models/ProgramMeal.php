<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramMeal extends Model
{
    use HasFactory;


    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function foods() {
        return $this->hasManyThrough(Food::class,MealFood::class);
    }
}
