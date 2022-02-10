<x-guest-layout>

    <div>
        <ul>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <a class="cursor-pointer text-2xl" rel="alternate" hreflang="{{ $localeCode }}"
                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $localeCode }}
                </a>
            @endforeach
        </ul>
    </div>
    
    <livewire:welcome/>

</x-guest-layout>
