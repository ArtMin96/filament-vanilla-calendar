<?php

namespace ArtMin96\FilamentVanillaCalendar;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentVanillaCalendarServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-vanilla-calendar';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews();
    }

    public function packageBooted(): void
    {
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName(),
        );
    }

    protected function getAssetPackageName(): string
    {
        return 'artmin96/filament-vanilla-calendar';
    }

    protected function getAssets(): array
    {
        return [
            Css::make('filament-vanilla-calendar-style', __DIR__ . '/../resources/dist/filament-vanilla-calendar.css'),
            AlpineComponent::make('filament-vanilla-calendar', __DIR__ . '/../resources/dist/filament-vanilla-calendar.js'),
        ];
    }
}
