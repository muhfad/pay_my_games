<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show($id)
    {
        $order = Order::with(['produk','game'])
            ->where('orders_id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Redirect jika sudah dibayar
        if ($order->status_orders !== 'pending') {
            return redirect('/my-orders')->with('info', 'Order ini sudah diproses');
        }

        return view('payment', compact('order'));
    }

    public function confirm($id)
    {
        $order = Order::where('orders_id', $id)
            ->where('user_id', auth()->id())
            ->where('status_orders', 'pending')
            ->first();

        if (!$order) {
            return redirect('/my-orders')->with('error', 'Order tidak ditemukan atau sudah diproses');
        }

        $order->update(['status_orders' => 'success']); // GANTI dari 'paid' ke 'success'

        return redirect('/my-orders')->with('success','Pembayaran berhasil dikonfirmasi');
    }
}