<x-app>

    <x-slot name="header">
        <book-header :book="{{ json_encode($book) }}"></book-header>
    </x-slot>

    <div class="p-6 bg-white border-b border-gray-200">
        hello {{ $book->name }}
    </div>

</x-app>
