<?php

use App\Http\Controllers\CompanyController as CompanyControllerAlias;
use App\Http\Controllers\CompanyPackageController as CompanyPackageControllerAlias;
use App\Http\Controllers\CompanyPaymentController as CompanyPaymentControllerAlias;
use App\Http\Controllers\PackageController as PackageControllerAlias;
use App\Http\Controllers\ProgramsController as ProgramsController;
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

//Route::get('/', [CompanyControllerAlias::class, 'index'])->name('index');
//Route::get('/{id}', [CompanyPaymentControllerAlias::class, 'check'])->name('index');

Route::group(['prefix' => 'programs'], function () {
    Route::get('/{token}', [ProgramsController::class, 'get'])->name('program.get');
    Route::post('/add', [ProgramsController::class, 'add'])->name('program.add');
    Route::put('/update/{token}', [ProgramsController::class, 'update'])->name('program.update');
    Route::delete('/delete/{token}', [ProgramsController::class, 'delete'])->name('program.delete');
});

Route::delete('/seed', [ProgramsController::class, 'seed'])->name('seed');
