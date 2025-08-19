<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailsController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/suggestions', [DetailsController::class, 'getSuggestions']);
Route::get('/details/encrypt', [DetailsController::class, 'encryptData']);