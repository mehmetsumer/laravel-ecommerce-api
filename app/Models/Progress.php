<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $timestamps = false;


    public function program() {
        return $this->belongsTo(Program::class);
    }
}
