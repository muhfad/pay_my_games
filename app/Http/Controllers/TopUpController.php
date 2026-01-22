<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Order;

class TopUpController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required',
            'user_game_id' => 'required'
        ]);

        $produk = Produk::where('produk_id', $request->produk_id)->firstOrFail();

        Order::create([
            'user_id' => auth()->id(),
            'produk_id'      => $produk->produk_id,
            'games_id'       => $produk->games_id,
            'metode_id'      => 1,
            'status_orders'  => 'pending',
            'jumlah_bayar'   => $produk->harga,
            'kode_unik'      => rand(100,999),
            'tanggal_orders' => now()
        ]);

        return redirect()->back()->with('success', 'Order berhasil dibuat');
    }
}
