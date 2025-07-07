<?php

use Illuminate\Support\Facades\Route;


Route::get('/', \App\Livewire\Frontend\Home\Index::class)->name('home.index');
Route::get('/team/onboarding', \App\Livewire\Frontend\Onboarding\Index::class)->name('team.onboarding');
