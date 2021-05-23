<x-master>
    <top-navigation></top-navigation>

    <!-- Page Content -->
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <main class="bg-white shadow-sm sm:rounded-lg max-h-full">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-master>
