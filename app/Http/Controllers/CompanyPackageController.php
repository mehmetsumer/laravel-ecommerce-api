<?php


namespace App\Http\Controllers;


use App\Models\CompanyPackage;
use App\Models\Package;
use Illuminate\Http\Request;

class CompanyPackageController extends Controller
{

    public function add(Request $request)
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


/*
 * Şirketin paket bitiş tarihine bakılacak, bu tarih geçildiyse ödeme alınacak.
 *
 *
 * */

}