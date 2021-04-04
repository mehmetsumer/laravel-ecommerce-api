<?php


namespace App\Http\Controllers;


use App\Classes\Helper;
use App\Models\Company;
use App\Models\CompanyPackage;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index() {
        return view("index");
    }

    public function check(Request $request) {
        $pack = CompanyPackage::where("company_id", $request->attributes->get('id'))->where("status", 1)->first();
        if($pack) {
            $res["package"] = $pack->package->toArray();
        }else {
            $res["package"] = "No Active Package Found.";
        }
        $request->attributes->add($res);
        return dd($request->attributes);
    }

    public function add(Request $request)
    {
        $request->validate([
            'site_url' => 'required',
            'name' => 'required',
            'lastname' => 'required',
            'company_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $token = Helper::quickRandom(40);
        $insertID = Company::create([
            'site_url' => $request->site_url,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'password' => $request->password,
            'token' => $token,
        ]);
        if ($insertID->id) {
            $insertID = $insertID->id;
            $response = ["company_id" => $insertID, "status" => true, "token" => $token . " (Don't lose this token.)"];
            // Company::find($insertID)->post_name
        } else {
            $response = ["status" => false, "error" => "Bir hata oluştu"];
        }

        return $response;
    }
}