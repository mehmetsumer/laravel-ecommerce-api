<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "companies";
    protected $fillable = ['site_url', 'name', 'lastname', 'company_name', 'email', 'password', 'token'];
    protected $hidden = [
        'password', 'token'
    ];

    public function package() {
        return $this->hasOneThrough(
            Package::class,
            CompanyPackage::class,
            'company_id', // Foreign key on the cars table...
            'id', // Foreign key on the owners table...
            'id', // Local key on the mechanics table...
            'package_id' // Local key on the cars table...
        );
    }

    public function packages() {
        return $this->hasMany('App\Models\CompanyPackage', 'company_id', 'id');
    }

    public function payments() {
        return $this->hasMany('App\Models\CompanyPayment', 'company_id', 'id');
    }

}
