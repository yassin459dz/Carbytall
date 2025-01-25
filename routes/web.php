<?php

use App\livewire\Car;
use App\Livewire\EditFacture;
use App\livewire\pos;
use App\livewire\Brand;
use App\livewire\Client;
use App\Livewire\Front;
use App\livewire\Facture;
use App\livewire\EditBrand;
use App\livewire\Matricule;
use App\livewire\Dashboardlive;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestingController;
use App\Livewire\ListFacture;
use App\Livewire\ViewFacture;

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

     Route::get('/front', Front::class)
     ->middleware(['auth', 'verified'])
     ->name('front');

     Route::get('/allfacture', ListFacture::class)
     ->middleware(['auth', 'verified'])
     ->name('ListFacture');

    Route::get('/editfacture/{edit}', EditFacture::class)
    ->middleware(['auth', 'verified'])
    ->name('editfacture');

    Route::get('/facture/view/{id}', ViewFacture::class)
    ->middleware(['auth', 'verified'])
    ->name('viewfacture');


require __DIR__.'/auth.php';

Route::get('/testing-pos',[TestingController::class, 'testingPos']);


