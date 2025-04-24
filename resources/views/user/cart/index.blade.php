<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Keranjang Saya
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        @if($carts->isEmpty())
            <div class="text-center text-gray-500 dark:text-gray-300">Keranjang kosong.</div>
        @else
            <table class="w-full table-auto bg-white dark:bg-gray-800 rounded shadow overflow-hidden">
                <thead class="bg-gray-200 dark:bg-gray-700 text-left">
                    <tr>
                        <th class="p-3">Produk</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Jumlah</th>
                        <th class="p-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                        <tr class="border-t dark:border-gray-700">
                            <td class="p-3">{{ $cart->product->name }}</td>
                            <td class="p-3">Rp {{ number_format($cart->product->price) }}</td>
                            <td class="p-3">{{ $cart->quantity }}</td>
                            <td class="p-3">Rp {{ number_format($cart->product->price * $cart->quantity) }}</td>
                        </tr>
                    @endforeach
                    <tr class="border-t font-bold bg-gray-100 dark:bg-gray-700">
                        <td colspan="3" class="p-3 text-right">Total</td>
                        <td class="p-3">Rp {{ number_format($total) }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4 text-right">
                <a href="{{ route('cart.checkout') }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Checkout via WhatsApp
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
