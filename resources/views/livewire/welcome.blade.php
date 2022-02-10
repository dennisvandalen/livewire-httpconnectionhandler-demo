<div>
    <div>
        Hello from {{ App::getLocale() }}.
    </div>

    <div>{{ $count }}</div>

    <x-jet-button wire:click="increaseCount">
        increaseCount()
    </x-jet-button>
</div>
