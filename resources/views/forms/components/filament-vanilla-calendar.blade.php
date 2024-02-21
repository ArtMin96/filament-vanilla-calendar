@php
    use Filament\Support\Facades\FilamentView;

    $getState = $getState();
    $hasInlineLabel = $hasInlineLabel();
    $extraAlpineAttributes = $getExtraAlpineAttributes();
    $id = $getId();
    $isDisabled = $isDisabled();
    $isLive = $isLive();
    $isLiveOnBlur = $isLiveOnBlur();
    $isLiveDebounced = $isLiveDebounced();
    $getMaxDate = $getMaxDate();
    $getMaxValue = $getMaxValue();
    $getMinDate = $getMinDate();
    $getMinValue = $getMinValue();
    $getToday = $getToday();
    $getSelectedTime = $getSelectedTime();
    $isPrefixInline = $isPrefixInline();
    $isSuffixInline = $isSuffixInline();
    $liveDebounce = $getLiveDebounce();
    $prefixActions = $getPrefixActions();
    $prefixIcon = $getPrefixIcon();
    $prefixLabel = $getPrefixLabel();
    $suffixActions = $getSuffixActions();
    $suffixIcon = $getSuffixIcon();
    $suffixLabel = $getSuffixLabel();
    $statePath = $getStatePath();
    $type = $getType();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
    :has-inline-label="$hasInlineLabel"
>
    <x-slot
        name="label"
        @class([
            'sm:pt-1.5' => $hasInlineLabel,
        ])
    >
        {{ $getLabel() }}
    </x-slot>

    <div x-ignore
         @if (FilamentView::hasSpaMode())
              ax-load="visible"
         @else
             ax-load
         @endif
         ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-vanilla-calendar', 'artmin96/filament-vanilla-calendar') }}"
         x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('filament-vanilla-calendar-style', package: 'artmin96/filament-vanilla-calendar'))]"
         x-data="vanillaCalendarPicker({
             state: $wire.$entangle('{{ $statePath }}'),
             isLive: @js($isLive),
             isLiveDebounced: @js($isLiveDebounced),
             isLiveOnBlur: @js($isLiveOnBlur),
             liveDebounce: @js($liveDebounce),
             type: @js($getCalendarType()),
             months: @js($getMonths()),
             jumpMonths: @js($getJumpMonths()),
             date: { min: @js($getMinDate), max: @js($getMaxDate), today: new Date(@js($getToday)) },
             settings: @js($getSettings()),
         })"
    >
        <x-filament::input.wrapper
            :disabled="$isDisabled"
            :inline-prefix="$isPrefixInline"
            :inline-suffix="$isSuffixInline"
            :prefix="$prefixLabel"
            :prefix-actions="$prefixActions"
            :prefix-icon="$prefixIcon"
            :prefix-icon-color="$getPrefixIconColor()"
            :suffix="$suffixLabel"
            :suffix-actions="$suffixActions"
            :suffix-icon="$suffixIcon"
            :suffix-icon-color="$getSuffixIconColor()"
            :valid="! $errors->has($statePath)"
        >
            <x-filament::input
                :attributes="
                    \Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())
                        ->merge($extraAlpineAttributes, escape: false)
                        ->merge([
                            'inlinePrefix' => $isPrefixInline && (count($prefixActions) || $prefixIcon || filled($prefixLabel)),
                            'inlineSuffix' => $isSuffixInline && (count($suffixActions) || $suffixIcon || filled($suffixLabel)),
                            'class' => 'artmins96-vanilla-calendar',
                            'disabled' => $isDisabled,
                            'id' => $id,
                            'max' => $getMaxValue,
                            'min' => $getMinValue,
                            'placeholder' => $getPlaceholder(),
                            'readonly' => $isReadOnly(),
                            'required' => $isRequired(),
                            'type' => $type,
                            $applyStateBindingModifiers('wire:model') => $statePath,
                            'x-ref' => 'vanillaCalendar',
                            'x-model' . ($isLiveDebounced ? '.debounce.' . $liveDebounce : null) => 'state',
                            'x-on:blur' => $isLiveOnBlur ? 'commitState()' : null,
                        ], escape: false)
                "
            />
        </x-filament::input.wrapper>
    </div>
</x-dynamic-component>
