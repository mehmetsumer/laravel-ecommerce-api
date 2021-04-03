<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "packages";
    protected $fillable = [ "package_name" ];

    public function company()
    {
        return $this->hasOne('App\Models\Company', 'company_id', 'id');
    }

}
