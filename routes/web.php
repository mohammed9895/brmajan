<?php

use Illuminate\Support\Facades\Route;


Route::get('/language/{locale}', function ($locale) {
    session()->put('lang', $locale);

    return redirect()->back();
})->name('locale');

Route::get('/', \App\Livewire\Frontend\Home\Index::class)->name('home.index');
Route::get('/user/onboarding', \App\Livewire\Frontend\Onboarding\Index::class)->name('user.onboarding');

Route::get('/challenges', \App\Livewire\Frontend\Challenges\Index::class)->name('challenges.index');;
Route::get('/challenges/{challenge}', \App\Livewire\Frontend\Challenges\Show::class)->name('challenges.show');;

