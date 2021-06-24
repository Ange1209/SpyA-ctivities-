<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\backOffice\AdminController;
use App\Http\Controllers\backOffice\BonusController;
use App\Http\Controllers\backOffice\EmpController;
use App\Http\Controllers\backOffice\ManagerController;
use App\Http\Controllers\backOffice\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

// UserController

Route::get('/parametre', [UserController::class, 'index'])
                ->middleware('auth')->name('parametre');

Route::get('/userParametre', [UserController::class, 'paramUserShow'])
                ->middleware('auth')->name('paramUser');

Route::post('/envoyer-demande', [UserController::class, 'storeAsk'])
                ->middleware('auth')->name('storeAsk');

Route::get('/demande', [UserController::class, 'initieDemande'])
                ->middleware('auth')->name('initieDemande');


Route::get('/editDemande/{demande}', [UserController::class, 'editDemande'])
                ->middleware('auth')->name('editDemande');

Route::get('/supprimeDemande/{demande}', [UserController::class, 'destroyAsk'])
                ->middleware('auth')->name('supprimer');


Route::patch('/modifierDemande/{demande}', [UserController::class, 'updateAsk'])
                ->middleware('auth')->name('updateAsk');                


Route::patch('/editUser/{user}', [UserController::class, 'paramUserUpdate'])
                    ->middleware('auth')->name('paramUserUpdate');
    
Route::patch('/editPwd/{user}', [UserController::class, 'pwdUpdate'])
                    ->middleware('auth')->name('pwdUpdate');

Route::patch('/storeImage/{user}', [UserController::class, 'storeImage'])
                    ->middleware('auth')->name('storeImage');

Route::get('/dashboard',[UserController::class, 'userProfile'])
                    ->middleware('auth','admin_action')->name('dashboard');

Route::get('/employes',[UserController::class, 'showEmp'])
                    ->middleware('auth','admin_action')->name('employe');

Route::get('/activer/{uuid}',[UserController::class, 'activateUser'])
                    ->middleware('auth','admin_action')->name('activation');

Route::get('/bloquer/{uuid}',[UserController::class, 'blockUser'])
                    ->middleware('auth','admin_action')->name('bloquer');

Route::patch('/role/{uuid}', [UserController::class, 'userRole'])
                    ->middleware('auth')->name('role'); 

Route::get('/show/{uuid}', [UserController::class, 'showUser'])
                    ->middleware('auth')->name('show');                  

// EmpController

Route::get('/Demande', [EmpController::class, 'askShow'])
                    ->middleware('auth')->name('showDemande');
// ManagerController


Route::get('/Demandes', [ManagerController::class, 'demandes'])
                    ->middleware('auth')->name('showAllAsk');

Route::get('/BonusDepartement', [ManagerController::class, 'bonus'])
                    ->middleware('auth')->name('depBonus');

Route::get('/showRead/{item}', [ManagerController::class, 'showRead'])
                    ->middleware('auth')->name('showRead'); 

Route::get('/askStatutval/{demande}', [ManagerController::class, 'validAsk'])
                    ->middleware('auth')->name('valid'); 

Route::get('/askStatutref/{demande}', [ManagerController::class, 'refusAsk'])
                    ->middleware('auth')->name('refus'); 
Route::get('/bonusValid/{bonus}', [ManagerController::class, 'validBonus'])
                    ->middleware('auth')->name('bonusValid'); 
Route::get('/bonusRefus/{bonus}', [ManagerController::class, 'refusBonus'])
                    ->middleware('auth')->name('bonusRefus'); 

Route::post('/approuver-bonus/{bonus}', [ManagerController::class, 'storeNotif'])
                ->middleware('auth')->name('storeNotif');

              
//AdminController                    
Route::get('/Departement/{department}', [AdminController::class, 'showDep'])
                    ->middleware('auth')->name('departement'); 



//BonusController

Route::get('/inibonus', [BonusController::class, 'initieBonus'])
                ->middleware('auth')->name('initieBonus');


Route::get('/editBonus/{bonus}', [BonusController::class, 'editBonus'])
                ->middleware('auth')->name('editBonus');               

Route::post('/envoyer-bonus', [BonusController::class, 'storeBonus'])
                ->middleware('auth')->name('storeBonus');

Route::get('/showBonus/{item}', [BonusController::class, 'showBonus'])
                    ->middleware('auth')->name('showBonus'); 

Route::patch('/modifierBonus/{bonus}', [BonusController::class, 'updateBonus'])
                                    ->middleware('auth')->name('updateBonus');  

Route::get('/supprimeBonus/{bonus}', [BonusController::class, 'destroyBonus'])
                ->middleware('auth')->name('supprimerBonus');

Route::get('/Bonus', [BonusController::class, 'bonusShow'])
                ->middleware('auth')->name('allBonus');