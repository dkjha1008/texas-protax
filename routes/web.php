<?php

use App\Http\Controllers\DetailsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/suggestions', [DetailsController::class, 'getSuggestions'])->name('details.suggestions');

Route::post('/details/encrypt', [DetailsController::class, 'encryptData'])->name('details.encrypt');

Route::get('/details', [DetailsController::class, 'index'])->name('details.index');