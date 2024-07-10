<?php

namespace TomatoPHP\FilamentTranslationComponent;

use Illuminate\Support\ServiceProvider;


class FilamentTranslationComponentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/filament-translation-component.php', 'filament-translation-component');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/filament-translation-component.php' => config_path('filament-translation-component.php'),
        ], 'filament-translation-component-config');

        //Register Lang
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'filament-translation-component');

        //Publish Lang
        $this->publishes([
            __DIR__.'/../resources/lang' => base_path('lang/vendor/filament-translation-component'),
        ], 'filament-translation-component-lang');

        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-translation-component');

        //Publish Views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/filament-translation-component'),
        ], 'filament-translation-component-views');

    }

    public function boot(): void
    {
        //you boot methods here
    }
}
