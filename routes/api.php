<?php

use App\Http\Controllers\ApiController as ApiControllerAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', [ApiControllerAlias::class, 'index'])->name('api.index');

Route::group(['prefix' => 'company'], function () {
    Route::middleware(['istokenvalid'])->group(function () {
        Route::post('/', [ApiControllerAlias::class, 'checkCompany'])->name('api.checkCompany');
        Route::post('/packages/new', [ApiControllerAlias::class, 'addCompanyPackage'])->name('api.add_company_package');
        Route::post('/payments/new', [ApiControllerAlias::class, 'addPayment'])->name('api.add_payment');
    });

    Route::post('/new', [ApiControllerAlias::class, 'addCompany'])->name('api.add_company');
});

Route::post('/packages/new', [ApiControllerAlias::class, 'addPackage'])->name('api.add_package');
