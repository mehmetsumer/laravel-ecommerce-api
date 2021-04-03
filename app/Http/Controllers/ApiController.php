<?php

namespace App\Http\Controllers;

use App\Classes\Helper;
use App\Models\Company;
use App\Models\CompanyPackage;
use App\Models\CompanyPayment;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Exception\Exception;

class ApiController
{
    public function index()
    {
        return view('index');
    }

    public function checkCompany(Request $request) {
        $res["package"] = CompanyPackage::where("company_id", $request->attributes->get('id'))->first()->package->toArray();
        $request->attributes->add($res);
        return dd($request->attributes);
    }

    public function addCompany(Request $request)
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

    public function addCompanyPackage(Request $request)
    {
        try {
            $request->validate([
                'company_id' => 'required',
                'package_id' => 'required',
                'type' => 'required',
            ]);
            $package = Package::find($request->package_id);
            if (!$package) {
                $response = ["error" => "Couldn't find package."];

                return $response;
            }
            $start_date = now();
            if ($request->type == 0) {
                $end_date = $start_date->addMonth();
            } else if ($request->type == 1) {
                $end_date = $start_date->addYear();
            } else {
                return ["error" => "Type is wrong."];
            }
            $insertID = CompanyPackage::create([
                'company_id' => $request->company_id,
                'package_id' => $request->package_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]);
            if ($insertID->id) {
                $response = ["status" => true, "start_date" => $start_date, "end_date" => $end_date, "package" => $package];
                // Company::find($insertID)->post_name
            } else {
                $response = ["status" => false, "error" => "Bir hata oluştu"];
            }
        } catch (\Exception $e) {
            report($e);
            $response = ["status" => false, "error" => $e->getMessage()];
        }

        return $response;
    }

    public function addPayment(Request $request)
    {
        try {
            $request->validate([
                'company_id' => 'required',
                'payment' => 'required'
            ]);
            $insertID = CompanyPayment::create([
                'company_id' => $request->company_id,
                'payment' => $request->payment,
            ]);
            if ($insertID->id) {
                $response = [ "status" => true, "message" => "Payment " . $request->payment . " added." ];
            } else {
                $response = [ "status" => false, "error" => "Bir hata oluştu" ];
            }
        } catch (\Exception $e) {
            $response = ["status" => "0 (Error)", "error" => $e->getMessage()];
        }

        return $response;
    }

    public function addPackage(Request $request)
    {
        try {
            $request->validate([
                'package_name' => 'required',
            ]);
            $insertID = Package::create([
                'package_name' => $request->package_name,
            ]);
            if ($insertID->id) {
                $response = ["status" => true, "message" => "Package " . $request->package_name . " added."];
            } else {
                $response = ["status" => false, "error" => "Bir hata oluştu"];
            }
        } catch (\Exception $e) {
            $response = ["status" => "0 (Error)", "error" => $e->getMessage()];
        }

        return $response;
    }
}
