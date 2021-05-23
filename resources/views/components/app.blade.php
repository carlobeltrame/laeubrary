<x-master>
    <top-navigation></top-navigation>

    <!-- Page Heading -->
    @if(isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <main class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-master>
