<?php


namespace App\Http\Controllers;

use App\Console\Commands\CheckPaymentsCmd;
use App\Jobs\CheckPaymentsJob;
use App\Models\CompanyPackage;
use App\Models\CompanyPayment;
use Illuminate\Http\Request;

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

    /* Id 0 gelirse tüm şirket paketleri tek tek kontrol edilip
       süresi geçenlerin ödemesi alınacak. Ödemesi alınamazsa 1 gün sonrasına queue ayarlanıcak.
        Bu queue ayarlanırken de o paket id' si gönderilecek ve fonksiyon sadece bu paket için
        çalışmış olacak.
    */
    public static function check($id=0) {
        $response = [];
        if($id != 0) {
            $val = CompanyPackage::find($id);
            if(!$val) {
                $response[$id]["message"] = "Hata";
                return json_encode($response,1);
            }
            $succ = rand(0, 100);
            $statt = 1;
            if($succ % 2 != 0) {
                //para çekme başarılı.
                if($val->type == 0) {
                    $end_date = now()->addMonth();
                }else {
                    $end_date = now()->addYear();
                }
                $val->update([
                    'status' => 1,
                    'start_date' => now(),
                    'end_date' => $end_date,
                ]);
                $response[$id]["succeed"] = $val;
            }
            else {
                //para çekme başarısız.
                $statt = 0;
                // Burda ertesi gün denenmek üzere kuyruğa alınacak.
                $response[$id]["failed"] = $val;
                $failCount = CompanyPayment::where("id", $val->company_id)->where("status", 0)->count();
                if($failCount >= 2) {
                    $val->update([
                        'status' => 0,
                        'end_date' => now(),
                    ]);
                    $response[$id]["cancelled"] = $val;
                } else {
                    $job = (new CheckPaymentsJob($val->id))->delay(now()->addDay());
                    dispatch($job);
                }
            }
            CompanyPayment::create([
                'company_id' => $val->company_id,
                'payment' => 15,
                'status' => $statt,
            ]);
        }
        else {
            $expired = CompanyPackage::where("status", 1)->where("end_date", "<", now())->get();
            //return $expired;

            if(count($expired) == 0) {
                $response["message"] = "Süresi geçmiş aktif paket bulunamadı.";
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
                    $val->update([
                        'status' => 1,
                        'start_date' => now(),
                        'end_date' => $end_date,
                    ]);
                    $response["payment"]["succeed"][] = $val;
                } else {
                    //para çekme başarısız.
                    $statt = 0;
                    // Burda ertesi gün denenmek üzere kuyruğa alınacak.
                    $response["payment"]["failed"][] = $val;

                    $job = (new CheckPaymentsJob($val->id))->delay(now()->addDay());
                    dispatch($job);
                    $val->update([
                        'status' => 2,
                        'end_date' => now(),
                    ]);
                }
                CompanyPayment::create([
                    'company_id' => $val->company_id,
                    'payment' => 15,
                    'status' => $statt,
                ]);
                $failCount = CompanyPayment::where("id", $val->company_id)->where("status", 0)->count();
                if($failCount >= 3) {
                    $val->update([
                        'status' => 0,
                        'end_date' => now(),
                    ]);
                    $response["package"]["cancelled"][] = $val;
                }
            }
        }

        return json_encode($response,1);
    }


}
