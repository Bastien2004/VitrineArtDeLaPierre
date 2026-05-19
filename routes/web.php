<?php

use App\Http\Controllers\ConfigurateurController;
use App\Livewire\RecruitmentForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComparaisonController;

Route::get('/', [ComparaisonController::class, 'index']);
Route::get('/recrutement', RecruitmentForm::class)->name('recrutement');
Route::get('/configurateur', [ConfigurateurController::class, 'index'])->name('configurateur');
Route::post('/configurateur/envoyer-mail', [ConfigurateurController::class, 'envoyerMail']);
