<x-app>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Übersicht
        </h2>
    </x-slot>

    <book-list :data="{{ json_encode($books) }}" class="max-w-full"></book-list>

</x-app>
