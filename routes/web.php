<?php

use Illuminate\Support\Facades\Route;





Route::get('/',\App\Livewire\Screen\Home::class);


Route::get('/recommandations', \App\Livewire\Screen\RecommandationView::class)->name('recommandations');

Route::get('/bonne-pratiques', \App\Livewire\Screen\BonnePratique::class)->name('bonnesPratiques');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/evaluer-votre-risque', \App\Livewire\Screen\PredictionView::class)->name('evaluerRisque');

});
