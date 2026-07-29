<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');
Route::post('/contato', [PortfolioController::class, 'contact'])
    ->middleware('throttle:contact')
    ->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])
        ->middleware('throttle:admin-login')
        ->name('login.store');

    Route::middleware('admin')->group(function (): void {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
        Route::put('/perfil', [AdminController::class, 'updateProfile'])->name('profile.update');

        Route::post('/tecnologias', [AdminController::class, 'storeSkill'])->name('skills.store');
        Route::put('/tecnologias/{skill}', [AdminController::class, 'updateSkill'])->name('skills.update');
        Route::delete('/tecnologias/{skill}', [AdminController::class, 'destroySkill'])->name('skills.destroy');

        Route::post('/projetos', [AdminController::class, 'storeProject'])->name('projects.store');
        Route::put('/projetos/{project}', [AdminController::class, 'updateProject'])->name('projects.update');
        Route::delete('/projetos/{project}', [AdminController::class, 'destroyProject'])->name('projects.destroy');

        Route::post('/experiencias', [AdminController::class, 'storeExperience'])->name('experiences.store');
        Route::put('/experiencias/{experience}', [AdminController::class, 'updateExperience'])->name('experiences.update');
        Route::delete('/experiencias/{experience}', [AdminController::class, 'destroyExperience'])->name('experiences.destroy');

        Route::delete('/mensagens/{message}', [AdminController::class, 'destroyMessage'])->name('messages.destroy');
    });
});
