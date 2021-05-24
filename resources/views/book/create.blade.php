<x-app>

    <x-slot name="header">
        <book-header :book="{{ json_encode([ 'name' => 'Neues Buch erfassen' ]) }}"></book-header>
    </x-slot>

    <book-create class="max-w-full"></book-create>

</x-app>
