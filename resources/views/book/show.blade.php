<x-app>

    <x-slot name="header">
        <book-header :book="{{ json_encode($book) }}"></book-header>
    </x-slot>

    <div class="p-6">
        <book-detail :book="{{ json_encode($book) }}"></book-detail>
    </div>

</x-app>
