<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;

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

Route::get('/{year?}/{month?}', [CalendarController::class, 'index'])
    ->middleware('auth')
    ->name('index')
    ->where(['year' => '[0-9]+', 'month' => '[0-9]+']);;




require __DIR__.'/auth.php';
