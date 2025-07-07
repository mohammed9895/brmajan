<?php

namespace App\Providers;

use App\Http\Middleware\EnsureUserHasTeam;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar','en']); // also accepts a closure
        });
        FilamentColor::register([
            'danger' => Color::Red,
            'info' => Color::Blue,
            'primary' => '#4150A2',
            'gray' => Color::Slate,
            'success' => Color::Green,
            'warning' => Color::Amber,
        ]);
    }
}
