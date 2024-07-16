<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'welcomePage'])->name('welcome');
Route::get('/account', [PagesController::class, 'accountPage'])->name('account');
Route::get('/rules', [PagesController::class, 'rulesPage'])->name('rules');
Route::get('/trainings', [PagesController::class, 'trainingsPage'])->name('trainings');

Route::post('check-user', [UserController::class, 'check_user']);

Route::post('/registration-user', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/get_cheques', [UserController::class, 'get_cheques']);
Route::post('/upload_cheque_from_account', [UserController::class, 'upload_cheque_from_account']);

Route::post('/send_email_exchange', [UserController::class, 'send_email_exchange']);
