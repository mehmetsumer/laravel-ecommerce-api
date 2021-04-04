<?php


namespace App\Http\Controllers;


use App\Models\CompanyPackage;
use App\Models\CompanyPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyPaymentController extends Controller
{

    public function add(Request $request)
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

    // bu fonksiyon cronlanacak.
    public function check() {
        $expired = CompanyPackage::where("status", 1)->where("end_date", "<", now())->get();
        //return $expired;
        $response = [];
        if(count($expired) == 0) {
            $response = "Süresi geçmiş aktif paket bulunamadı.";
            return $response;
        }
        foreach($expired as $val) {
            $succ = rand(0, 100);
            $statt = 1;
            if($succ % 2 != 0) {
                //para çekme başarılı.
                if($val->type == 0) {
                    $end_date = now()->addMonth();
                }else {
                    $end_date = now()->addYear();
                }
                /*$val->update([
                    'status' => 1,
                    'start_date' => now(),
                    'end_date' => $end_date,
                ]);*/
                $response["payment"]["succeed"][] = $val;
            } else {
                //para çekme başarısız.
                $statt = 0;
                // Burda ertesi gün denenmek üzere kuyruğa alınacak.
                $response["payment"]["failed"][] = $val;
            }
            CompanyPayment::create([
                'company_id' => $val->company_id,
                'payment' => 15,
                'status' => $statt,
            ]);
            $failCount = CompanyPayment::find($val->company_id)->where("status", 0)->count();
            if($failCount >= 3) {
                $val->update([
                    'status' => 0,
                    'end_date' => now(),
                ]);
                $response["package"]["cancelled"][] = $val;
            }
        }
        return $response;
    }

}