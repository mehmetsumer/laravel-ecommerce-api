<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{

    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string("token")->unique();
            $table->string("share_token")->unique();
            $table->string("title",50); // Program Adı
            $table->string("notes",2000)->nullable();
            $table->integer("status")->unsigned()->default(2);
            $table->integer("user_id")->unsigned()->default(0);
            /* status 2 ise public seçmiş ve beklemededir.
             * 0 ise onaylanmamış.
             * 1 ise aktif.
             * */
            $table->timestamps();
        });
    }

    /*
      ***WORKOUT:***
         Pazartesi:
                Bölge ekle:
                    göğüs
                        Hareket ekle:
                        XX hareketi 3 set
                    ön kol
                        Hareket ekle:
                        XX hareketi 3 set
        vs.vs.

    ->default('{ "monday": { "name": "İtme", "chest": "hareketler buraya gelicek.",
                             "shoulders": "omuz hareketleri.", "triceps": "triceps hareketleri"
                           },
                "tuesday": { "name": "Çekme", "chest": "hareketler buraya gelicek.",
                                         "shoulders": "omuz hareketleri.", "triceps": "triceps hareketleri"
                           },
                "wednesday": { "name": "Bacak", "chest": "hareketler buraya gelicek.",
                                                     "shoulders": "omuz hareketleri.", "triceps": "triceps hareketleri"
                             },
                "thursday": { "name": "--", "chest": "hareketler buraya gelicek.",
                                                                 "shoulders": "omuz hareketleri.", "triceps": "triceps hareketleri"
                            },
                "friday": { "name": "İtme", "chest": "hareketler buraya gelicek.",
                                                                 "shoulders": "omuz hareketleri.", "triceps": "triceps hareketleri"
                            },
                "saturday": { "name": "Çekme", "chest": "hareketler buraya gelicek.",
                                                                 "shoulders": "omuz hareketleri.", "triceps": "triceps hareketleri"
                            },
                "sunday": { "name": "--", "chest": "hareketler buraya gelicek.",
                                                                 "shoulders": "omuz hareketleri.", "triceps": "triceps hareketleri"
                           },
                }');

        ***NUTRITION:***
            Kahvaltı:
                besin ekle->kalori, protein, karb, yağ
            Öğle:
            İdman Sonrası:
            Akşam:
            Yatmadan:
        Bunlar default gelecek, adam isterse ekle çıkar yapabilecek.

        ***PROGRESS:***
           Tarih, omuz, göğüs, bel, kalça, baldır, kol, kilo bilgileri, nullable olur.
     * */


    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
