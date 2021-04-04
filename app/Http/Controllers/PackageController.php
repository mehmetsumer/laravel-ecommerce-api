<?php


namespace App\Http\Controllers;


use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    public function add(Request $request)
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