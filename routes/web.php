<?php

use App\Http\Controllers\ContactUsController;
use Illuminate\Support\Facades\Route;

Route::resource('contact', ContactUsController::class)->only([
    'index', 'store'
]);
