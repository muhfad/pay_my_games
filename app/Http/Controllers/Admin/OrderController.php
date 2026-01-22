<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders with filter and search
     */
    public function index(Request $request)
    {
        $query = Order::with(['produk', 'game', 'user']);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('orders_id', 'like', "%{$search}%")
                  ->orWhere('user_game_id', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('game', function($q) use ($search) {
                      $q->where('nama_games', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status_orders', $request->status);
        }

        $orders = $query->orderBy('orders_id', 'desc')->get();

        return view('admin.orders', compact('orders'));
    }

    /**
     * Update order status
     */
    public function updateStatus($id, $status)
    {
        // Validate status
        $validStatuses = ['pending', 'success', 'failed'];
        
        if (!in_array($status, $validStatuses)) {
            return back()->with('error', 'Status tidak valid');
        }

        $order = Order::where('orders_id', $id)->first();

        if (!$order) {
            return back()->with('error', 'Order tidak ditemukan');
        }

        $order->update(['status_orders' => $status]);

        return back()->with('success', "Status order #$id berhasil diubah menjadi '$status'");
    }

    /**
     * Show order detail
     */
    public function show($id)
    {
        $order = Order::with(['produk', 'game', 'user'])
            ->where('orders_id', $id)
            ->firstOrFail();

        return view('admin.order_detail', compact('order'));
    }

    /**
     * Delete order
     */
    public function destroy($id)
    {
        $order = Order::where('orders_id', $id)->first();

        if (!$order) {
            return back()->with('error', 'Order tidak ditemukan');
        }

        $order->delete();

        return redirect('/admin/orders')->with('success', "Order #$id berhasil dihapus");
    }
}