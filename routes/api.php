<?php

use App\Http\Controllers\Api\Advertisement\AdvertisementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/advertisements', [AdvertisementController::class, 'index'])->name('advertisements.index');
Route::post('/advertisements', [AdvertisementController::class, 'store'])->name('advertisements.store');
Route::get('/advertisements/{advertisement}', [AdvertisementController::class, 'show'])->name('advertisements.show');
Route::get('/advertisements/{advertisement}/{fields}', [AdvertisementController::class, 'show'])
    ->name('advertisements.show.fields')
    ->where('fields', 'fields');
