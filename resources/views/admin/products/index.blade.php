<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Produk') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <a href="{{ route('admin.products.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">+ Tambah Produk</a>

            @foreach ($products as $product)
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                    <p>Rp {{ number_format($product->price) }}</p>
                    <div class="mt-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
