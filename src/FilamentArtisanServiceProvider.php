<?php

namespace TomatoPHP\FilamentArtisan;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentArtisanServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-artisan';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations();
    }

    public function packageBooted(): void
    {
        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/filament-artisan.php', 'filament-artisan');
        //Publish Config
        $this->publishes([
            __DIR__.'/../config/filament-artisan.php' => config_path('filament-artisan.php'),
        ], 'filament-artisan-config');

        //Publish the styling with assets
        FilamentAsset::register([
            Css::make('filament-artisan', __DIR__ . '/../resources/css/filament-artisan.css'),
        ], package: 'filament-artisan');
        //Publish styling by command
        $this->publishes([
            __DIR__.'/../resources/css/filament-artisan.css' => base_path('public/css/app/filament-artisan.css'),
        ], 'filament-artisan-styles');

        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-artisan');
        //Publish Views
        $this->publishes([
            __DIR__.'/../resources/views/filament' => resource_path('views/vendor/filament-artisan'),
        ], 'filament-artisan-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'filament-artisan');
        //Publish Lang
        $this->publishes([
            __DIR__.'/../resources/lang' => base_path('lang/vendor/filament-artisan'),
        ], 'filament-artisan-lang');
    }
}
