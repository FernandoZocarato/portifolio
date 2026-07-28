<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');
Route::post('/contato', [PortfolioController::class, 'contact'])
    ->middleware('throttle:contact')
    ->name('contact.store');
