<div
        x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('filament-artisan', package: 'filament-artisan'))]"
>
    <x-filament-panels::page>
        {{ $this->table }}
    </x-filament-panels::page>
</div>

