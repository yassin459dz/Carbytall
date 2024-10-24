<?php

use Illuminate\Support\Facades\Route;
use App\livewire\Dashboardlive;
use App\livewire\Car;
use App\livewire\Brand;
use App\livewire\EditBrand;
use App\livewire\Client;

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

    Route::get('brand/{allbrand}/edit-brand', EditBrand::class)
    ->middleware(['auth', 'verified'])
    ->name('edit-brand');

     Route::get('/client', Client::class)
     ->middleware(['auth', 'verified'])
     ->name('client');


require __DIR__.'/auth.php';
