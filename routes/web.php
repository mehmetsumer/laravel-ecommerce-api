<?php

use App\Http\Controllers\ApiController as ApiControllerAlias;
use App\Http\Controllers\WorkoutController as WorkoutControllerAlias;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WorkoutControllerAlias::class, 'index'])->name('index');
Route::get('/{token}', [WorkoutControllerAlias::class, 'view'])->name('view');
Route::get('/edit/{token}', [WorkoutControllerAlias::class, 'update'])->name('update');

