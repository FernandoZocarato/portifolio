<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\PortfolioApiController;
use Illuminate\Support\Facades\Route;

Route::get('/profile', [PortfolioApiController::class, 'profile']);
Route::get('/skills', [PortfolioApiController::class, 'skills']);
Route::get('/projects', [PortfolioApiController::class, 'projects']);
Route::get('/experiences', [PortfolioApiController::class, 'experiences']);
Route::post('/contact', ContactController::class)->middleware('throttle:contact');
