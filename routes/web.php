<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\CritereController;

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

Route::resource('Centre', CentreController::class);
Route::resource('Critere', CritereController::class);
Route::resource('Formation', FormationController::class);

Route::post('/import', [ImportExcelController::class, 'import'])->name("importTraitement");
Route::get("/import", [ImportExcelController::class, 'index'])->name("import");

Route::get("/export", [ImportExcelController::class, 'export'])->name("export");

Route::post('/', [Controller::class, 'indexPost'])->name("search");
Route::get('/', [Controller::class, 'index'])->name("home");
