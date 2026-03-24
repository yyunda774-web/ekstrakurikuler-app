<?php

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pembina\DashboardController;

Route::middleware(['auth','pembina'])
    ->prefix('pembina')
    ->name('pembina.')
    ->group(function(){

        // Dashboard pembina
        Route::get('/dashboard',[DashboardController::class,'index'])
            ->name('dashboard');

        // Terima pendaftar
        Route::patch('/pendaftaran/{id}/terima',[DashboardController::class,'terima'])
            ->name('pendaftaran.terima');

        // Tolak pendaftar
        Route::patch('/pendaftaran/{id}/tolak',[DashboardController::class,'tolak'])
            ->name('pendaftaran.tolak');

});