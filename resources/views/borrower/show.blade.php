<x-app>

    <x-slot name="header">
        <borrower-header :borrower="{{ json_encode($borrower) }}"></borrower-header>
    </x-slot>

    <main class="bg-white shadow-sm sm:rounded-lg max-h-full overflow-hidden">
        <div class="p-6">
            <borrower-detail :borrower="{{ json_encode($borrower) }}"></borrower-detail>
        </div>
    </main>

</x-app>
