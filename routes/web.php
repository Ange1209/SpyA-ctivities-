<?php

use App\Http\Controllers\backOffice\ManagerController;
use App\Http\Controllers\backOffice\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
Route::get('/askStatutref/{demande}', [ManagerController::class, 'refusAsk'])
                    ->middleware('auth')->name('refus'); 
Route::get('/', function () {
    return view('auth.login');
});


Route::get('/infoNotice', function () {
    return view('infoNotice');
})->name('infoNotice');

Route::get('/note', function () {
    return view('notice');
})->name('notice');


require __DIR__.'/auth.php';
