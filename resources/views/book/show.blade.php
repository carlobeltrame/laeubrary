<x-app>

    <x-slot name="header">
        <book-header :book="{{ json_encode($book) }}"></book-header>
    </x-slot>

    <main class="bg-white shadow-sm sm:rounded-lg max-h-full overflow-hidden">
        <div class="p-6">
            <book-detail :book="{{ json_encode($book) }}"></book-detail>
        </div>
    </main>

</x-app>
