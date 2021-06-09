<?php

namespace Database\Seeders;

use App\Classes\Helper;
use App\Models\Area;
use App\Models\Company;
use App\Models\CompanyPackage;
use App\Models\CompanyPayment;
use App\Models\Move;
use App\Models\Package;
use App\Models\WorkoutDay;
use Illuminate\Database\Seeder;
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
        Area::create([ 'name' => 'Omuz', 'type' => 0 ]);
        Area::create([ 'name' => 'Bacak', 'type' => 1 ]);
        Area::create([ 'name' => 'Göğüs', 'type' => 0 ]);
        Area::create([ 'name' => 'Sırt', 'type' => 1 ]);
        Area::create([ 'name' => 'Ön Kol', 'type' => 0 ]);
        Area::create([ 'name' => 'Arka Kol', 'type' => 0 ]);

        Move::create([ 'name' => 'Shoulder Press', 'area_id' => 1]);
        Move::create([ 'name' => 'Dumbell Lateral Raise', 'area_id' => 1]);
        Move::create([ 'name' => 'Squat', 'area_id' => 2]);
        Move::create([ 'name' => 'Leg Press', 'area_id' => 2]);
        Move::create([ 'name' => 'Bench Press', 'area_id' => 3]);
        Move::create([ 'name' => 'Dumbell Fly', 'area_id' => 3]);
        Move::create([ 'name' => 'Deadlift', 'area_id' => 4]);
        Move::create([ 'name' => 'Pulldown', 'area_id' => 4]);
        Move::create([ 'name' => 'Incline Dumbell', 'area_id' => 5]);
        Move::create([ 'name' => 'Barbell Curl', 'area_id' => 5]);
        Move::create([ 'name' => 'Dips', 'area_id' => 6]);
        Move::create([ 'name' => 'Skullcrusher', 'area_id' => 6]);

        WorkoutDay::create([]);


    }

}
