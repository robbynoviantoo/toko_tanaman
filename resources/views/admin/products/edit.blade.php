<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Produk') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 p-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-200">Edit Produk</h1>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="space-y-4">
                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-indigo-500 dark:focus:border-indigo-500" 
                           required>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" 
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Harga -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-indigo-500 dark:focus:border-indigo-500" 
                           required>
                </div>

                <!-- Stok -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stok</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-indigo-500 dark:focus:border-indigo-500" 
                           required>
                </div>

                <!-- Gambar -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar</label>
                    <input type="file" name="image" id="image" 
                           class="mt-1 block w-full text-sm text-gray-500 file:py-2 file:px-4 file:border file:rounded-md file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 dark:file:bg-gray-700 dark:file:text-gray-300 dark:file:hover:bg-gray-600" 
                           accept="image/*">
                    @if ($product->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/app/public/' . $product->image) }}" alt="Product Image" class="w-32 h-32 object-cover rounded-md">
                        </div>
                    @endif
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                            class="w-full mt-4 px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
