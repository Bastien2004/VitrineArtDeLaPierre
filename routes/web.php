<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComparaisonController;

Route::get('/', [ComparaisonController::class, 'index']);
