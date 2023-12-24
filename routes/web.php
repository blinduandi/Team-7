<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchedulleGenerator;
use App\Http\Controllers\CreateCSV;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('view');
})->name('home');




Route::get('/generate', [SchedulleGenerator::class, 'generate']);
Route::get('/save', [CreateCSV::class, 'saveDataToCSV']);


