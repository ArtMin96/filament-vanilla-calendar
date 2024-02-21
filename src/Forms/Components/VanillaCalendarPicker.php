<?php

namespace ArtMin96\FilamentVanillaCalendar\Forms\Components;

use Filament\Forms\Components\Concerns\HasName;
use Filament\Forms\Components\TextInput;

class VanillaCalendarPicker extends TextInput
{
    use HasName;

    protected string $view = 'filament-vanilla-calendar::forms.components.filament-vanilla-calendar';

    /**
     * @see https://vanilla-calendar.pro/docs/learn/types-of-calendars/default
     */
    protected string $calendarType = 'default';

    protected int $months = 1;

    protected int $jumpMonths = 1;

    protected ?string $minDate = '';

    protected ?string $maxDate = '';

    protected ?string $today = '';

    protected ?string $selectedTime = '';

    protected array $settings = [];

    protected array $localeMonths = [];

    protected array $localeWeekday = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->autocomplete(false);
    }

    public function calendarType(string $type): static
    {
        $this->calendarType = $type;

        return $this;
    }

    public function getCalendarType(): string
    {
        return $this->calendarType;
    }

    public function months(int $months): static
    {
        $this->months = $months;

        return $this;
    }

    public function getMonths(): int
    {
        return $this->months;
    }

    public function jumpMonths(int $jumpMonths): static
    {
        $this->jumpMonths = $jumpMonths;

        return $this;
    }

    public function getJumpMonths(): int
    {
        return $this->jumpMonths;
    }

    public function minDate(string $minDate): static
    {
        $this->minDate = $minDate;

        return $this;
    }

    public function getMinDate(): ?string
    {
        return $this->minDate;
    }

    public function maxDate(string $maxDate): static
    {
        $this->maxDate = $maxDate;

        return $this;
    }

    public function getMaxDate(): ?string
    {
        return $this->maxDate;
    }

    public function today(string $today): static
    {
        $this->today = $today;

        return $this;
    }

    public function getToday(): ?string
    {
        return $this->today ?: now()->toDateString();
    }

    public function selectedTime(string $time): static
    {
        $this->selectedTime = $time;

        return $this;
    }

    public function getSelectedTime(): ?string
    {
        return $this->selectedTime;
    }

    public function settings(array $settings): static
    {
        $this->settings = $settings;

        return $this;
    }

    public function getSettings(): array
    {
        return array_merge($this->settings, [
            'visibility' => ['positionToInput' => 'center'],
        ]);
    }

    public function localeMonths(array $months): static
    {
        $this->localeMonths = $months;

        return $this;
    }

    public function getLocaleMonths(): array
    {
        return $this->localeMonths;
    }

    public function localeWeekday(array $weekday): static
    {
        $this->localeWeekday = $weekday;

        return $this;
    }

    public function getLocaleWeekday(): array
    {
        return $this->localeWeekday;
    }
}
