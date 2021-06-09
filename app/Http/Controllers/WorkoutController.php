<?php

namespace App\Http\Controllers;

use App\Classes\Helper;
use App\Models\Program;

class WorkoutController extends Controller
{

    public function index() {
        $token = Helper::quickRandom(20);
        $shareToken = Helper::quickRandom(20);
        return view('index', compact('token', 'shareToken'));
    }

    public function view($token) {


        $editable = True;
        $program = Program::where("token", $token)->first();
        if(!$program) {
            $program = Program::where("share_token", $token)->first();
            if(!$program) {
                return redirect("/");
            }
            $editable = False;
        }
        $program["workout"] = json_decode($program["workout"]);
        $program["nutrition"] = json_decode($program["nutrition"]);
        $program["progress"] = json_decode($program["progress"]);

        //return $program;
        return view('view', compact('program', 'editable'));
    }

    public function update($token) {
        $program = Program::where("token", $token)->first();
        if(!$program) {
            return redirect("/");
        }


        return $token . " düzenleniyor.";
    }
}
