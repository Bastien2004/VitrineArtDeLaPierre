<?php

use App\Http\Controllers\ConfigurateurController;
use App\Http\Controllers\PanoramaController;
use App\Http\Controllers\RealisationController;
use App\Livewire\RecruitmentForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComparaisonController;

Route::get('/recrutement', fn() => view('recrutement'))->name('recrutement');
Route::get('/configurateur', [ConfigurateurController::class, 'index'])->name('configurateur');
Route::post('/configurateur/envoyer-mail', [ConfigurateurController::class, 'envoyerMail']);
Route::get('/', [RealisationController::class, 'index'])->name('home');
Route::get('/panoramas', [PanoramaController::class, 'gallery'])->name('panoramas');
Route::view('/mentions-legales', 'mentions-legales')->name('mentions-legales');
Route::view('/politique-confidentialite', 'politique-confidentialite')->name('politique-confidentialite');
