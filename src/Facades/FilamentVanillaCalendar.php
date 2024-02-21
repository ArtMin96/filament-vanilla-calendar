<?php

namespace ArtMin96\FilamentVanillaCalendar\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ArtMin96\FilamentVanillaCalendar\FilamentVanillaCalendar
 */
class FilamentVanillaCalendar extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ArtMin96\FilamentVanillaCalendar\FilamentVanillaCalendar::class;
    }
}
