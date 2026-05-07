<?php

use App\Livewire\RecruitmentForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComparaisonController;

Route::get('/', [ComparaisonController::class, 'index']);
Route::get('/recrutement', RecruitmentForm::class)->name('recrutement');
