<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutArea extends Model
{
    use HasFactory;

    public function moves()
    {
        return $this->belongsToMany(Move::class);
    }
}
