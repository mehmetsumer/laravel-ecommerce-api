<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Program;
use App\Models\Workout;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{

    public function get($token) {
        $program = Program::where("token", $token)->first();
        if(!$program) {
            return [ 'status'=>False, 'message'=> 'Program bulunamadı' ];

        }

        return $program;
    }

    public function add(Request $request) {

    }

    public function update($token) {
        $program = Program::where("token", $token)->first();
        if(!$program) {
            return redirect("/");
        }

        return $token . " düzenleniyor.";
    }

    public function delete($id) {
        $program = Program::find($id);
        if(!$program) {
            return redirect("/");
        }
        $program->delete();
    }


    public function seed() {
        $programs = Program::factory()->count(5)->create();

        $workouts = Workout::factory()->count(5)->create();

        // SEED AREAS,
        // SEED MOVES



        return 0;
    }

}
