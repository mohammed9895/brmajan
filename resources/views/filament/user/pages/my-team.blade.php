<x-filament-panels::page>
    <form wire:submit="create">
        {{ $this->form }}
    </form>
    <x-filament-actions::modals />
</x-filament-panels::page>
