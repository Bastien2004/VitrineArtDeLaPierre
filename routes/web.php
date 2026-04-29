<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RealisationController;

Route::get('/', [RealisationController::class, 'index']);
