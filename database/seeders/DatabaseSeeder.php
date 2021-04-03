<?php

namespace Database\Seeders;

use App\Classes\Helper;
use App\Models\Company;
use App\Models\CompanyPackage;
use App\Models\CompanyPayment;
use App\Models\Package;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<5;$i++) {
            $last = Company::create([
                'site_url' => Str::random(15),
                'name' => Str::random(5),
                'lastname' => Str::random(5),
                'company_name' => Str::random(10),
                'email' => Str::random(15),
                'password' => bcrypt('password'),
                'token' => Helper::quickRandom(40),
            ]);
            $company_id = $last->id;
            $last = Package::create([
                'package_name' => Str::random(15),
            ]);
            $package_id = $last->id;
            CompanyPackage::create([
                'company_id' => $company_id,
                'package_id' => $package_id,
                'status' => 1,
                'end_date' => now()->addYear(),
            ]);
            CompanyPayment::create([
                'company_id' => $company_id,
                'payment' => rand(100, 1000),
                'status' => 1,
            ]);
        }


    }
}
