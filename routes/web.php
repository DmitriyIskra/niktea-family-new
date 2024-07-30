<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'welcomePage'])->name('welcome');
Route::get('/account', [PagesController::class, 'accountPage'])->name('account');
Route::get('/rules', [PagesController::class, 'rulesPage'])->name('rules');
Route::get('/trainings', [PagesController::class, 'trainingsPage'])->name('trainings');
Route::get('/panel', [PagesController::class, 'admin_panel'])->name('panel');

Route::post('/check-user', [UserController::class, 'check_user']);
Route::post('/check-email', [UserController::class, 'check_email']);

Route::post('/registration-user', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/get_cheques', [UserController::class, 'get_cheques']);
Route::post('/upload_cheque_from_account', [UserController::class, 'upload_cheque_from_account']);

Route::post('/send_email_exchange', [UserController::class, 'send_email_exchange']);



// АДМИН

Route::post('/search', [AdminController::class, 'search']);

Route::post('/blocking/{id}', [AdminController::class, 'update']);
Route::post('/edit_contacts/{id}', [AdminController::class, 'update']);
Route::delete('/delete/{action}/{id}', [AdminController::class, 'destroy']);

Route::post('/verified_cheque/{id}', [AdminController::class, 'update']); 

Route::post('/balls/{id}', [AdminController::class, 'update']);

Route::post('/lottery/{id}', [AdminController::class, 'update']); 

Route::post('/verifie_gift_point/{id}', [AdminController::class, 'update']); 
Route::post('/gift_point/{id}', [AdminController::class, 'update']); 

Route::post('/gift_lottery/{id}', [AdminController::class, 'update']);

Route::post('/awarded/{id}', [AdminController::class, 'update']); 





Route::fallback([PagesController::class, 'page_not_found']);