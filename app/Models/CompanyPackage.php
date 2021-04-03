<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPackage extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "company_packages";
    protected $fillable = [ "company_id", "package_id", "start_date", "end_date" ];

    public function company()
    {
        return $this->hasOne('App\Models\Company', 'company_id', 'id');
    }

    public function package()
    {
        return $this->hasOne('App\Models\Package', 'id', 'package_id');
    }
}
