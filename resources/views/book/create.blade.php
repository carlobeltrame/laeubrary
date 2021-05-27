<x-app>

    <x-slot name="header">
        <book-header :book="{{ json_encode([ 'name' => 'Neues Buch erfassen' ]) }}"></book-header>
    </x-slot>

    <main class="bg-white shadow-sm sm:rounded-lg max-h-full overflow-hidden">
        <book-create class="max-w-full"></book-create>
    </main>

</x-app>
