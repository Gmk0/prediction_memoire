<?php

use Illuminate\Support\Facades\Route;





Route::get('/',\App\Livewire\Screen\PredictionView::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
