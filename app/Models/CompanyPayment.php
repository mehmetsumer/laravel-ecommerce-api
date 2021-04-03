<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPayment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "company_payments";
    protected $fillable = [ "company_id", "payment" ];
}
