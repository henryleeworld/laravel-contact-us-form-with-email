<?php

use App\Http\Controllers\ContactUsController;
use Illuminate\Support\Facades\Route;

Route::get('/contact', [ContactUsController::class, 'index']);
Route::post('/contact', [ContactUsController::class, 'store'])->name('contact.store');
