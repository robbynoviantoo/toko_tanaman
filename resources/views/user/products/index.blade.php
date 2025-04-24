<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Produk Tanaman
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    @if($product->image)
                        <img src="{{ asset('storage/app/public/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t-xl mb-4">
                    @else
                        <div class="w-full h-48 bg-gray-300 rounded-t-xl mb-4"></div> <!-- Placeholder for products without image -->
                    @endif
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">{{ $product->description }}</p>
                    <p class="text-green-600 font-bold text-lg">Rp {{ number_format($product->price) }}</p>
                    <p class="text-sm text-gray-500">Stok: {{ $product->stock }}</p>

                    <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg transition duration-200 transform hover:scale-105">
                            Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500 dark:text-gray-300">Belum ada produk tersedia.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
