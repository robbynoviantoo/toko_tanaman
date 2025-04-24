<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        return view('user.cart.index', compact('carts', 'total'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;

        // Cek apakah produk sudah ada di keranjang user
        $existing = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($existing) {
            // Tambah jumlah
            $existing->increment('quantity');
        } else {
            // Buat baru
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function checkout()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // Total harga
        $total = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        // Format pesan untuk WhatsApp
        $message = "Checkout Produk:\n";
        foreach ($carts as $cart) {
            $message .= "Produk: {$cart->product->name}, Jumlah: {$cart->quantity}, Harga: Rp " . number_format($cart->product->price) . "\n";
        }
        $message .= "Total: Rp " . number_format($total) . "\n\n";
        $message .= "Silakan lakukan pembayaran melalui WhatsApp.";

        // Encode pesan untuk URL
        $encodedMessage = urlencode($message);

        // Nomor WhatsApp (gunakan nomor WhatsApp yang bisa dihubungi)
        $whatsappNumber = '6281215639028'; // Ganti dengan nomor WhatsApp yang sesuai

        // Link ke WhatsApp
        $whatsappLink = "https://wa.me/{$whatsappNumber}?text={$encodedMessage}";

        return redirect()->to($whatsappLink);
    }

    public function destroy($cartId)
    {
        $cart = Cart::findOrFail($cartId);
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function update(Request $request, Cart $cart)
    {
        $action = $request->input('action');
    
        if ($action === 'increase' && $cart->quantity < $cart->product->stock) {
            $cart->quantity += 1;
        } elseif ($action === 'decrease' && $cart->quantity > 1) {
            $cart->quantity -= 1;
        }
    
        $cart->save();
    
        return redirect()->route('cart.index')->with('success', 'Keranjang diperbarui.');
    }
}
