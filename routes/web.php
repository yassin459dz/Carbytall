<?php

use App\livewire\Car;
use App\livewire\pos;
use App\livewire\Brand;
use App\livewire\Client;
use App\livewire\Facture;
use App\livewire\EditBrand;
use App\livewire\Matricule;
use App\livewire\Dashboardlive;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestingController;



Route::view('/', 'welcome');

 Route::view('dashboard', 'dashboard')
     ->middleware(['auth', 'verified'])
     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::get('/car', Car::class)
    ->middleware(['auth', 'verified'])
    ->name('car');

    Route::get('/brand', Brand::class)
    ->middleware(['auth', 'verified'])
    ->name('brand');

    // Route::get('brand/{allbrand}/edit-brand', EditBrand::class)
    // ->middleware(['auth', 'verified'])
    // ->name('edit-brand');

     Route::get('/client', Client::class)
     ->middleware(['auth', 'verified'])
     ->name('client');

     Route::get('/matricule', Matricule::class)
     ->middleware(['auth', 'verified'])
     ->name('matricule');

     Route::get('/facture', facture::class)
     ->middleware(['auth', 'verified'])
     ->name('facture');

     Route::get('/pos', pos::class)
     ->middleware(['auth', 'verified'])
     ->name('pos');

require __DIR__.'/auth.php';

Route::get('/testing-pos',[TestingController::class, 'testingPos']);


