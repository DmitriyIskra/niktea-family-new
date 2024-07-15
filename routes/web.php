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

