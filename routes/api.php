<?php

use App\Http\Controllers\CompanyController as CompanyControllerAlias;
use App\Http\Controllers\CompanyPackageController as CompanyPackageControllerAlias;
use App\Http\Controllers\CompanyPaymentController as CompanyPaymentControllerAlias;
use App\Http\Controllers\PackageController as PackageControllerAlias;
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

Route::get('/', [CompanyControllerAlias::class, 'index'])->name('index');

Route::group(['prefix' => 'company'], function () {
    Route::middleware(['istokenvalid'])->group(function () {
        Route::post('/', [CompanyControllerAlias::class, 'check'])->name('company.check');
        Route::post('/packages/new', [CompanyPackageControllerAlias::class, 'add'])->name('companypackage.add');
        Route::post('/payments/new', [CompanyPaymentControllerAlias::class, 'add'])->name('companypayment.add');
    });

    Route::post('/new', [CompanyControllerAlias::class, 'add'])->name('company.add');
});

Route::post('/packages/new', [PackageControllerAlias::class, 'add'])->name('package.add');
