<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('home', compact('games'));
    }

    public function detail($id)
    {
        $game = Game::where('games_id', $id)->firstOrFail();
        $produk = $game->produk;

        return view('game_detail', compact('game', 'produk'));
    }

    public function orders()
    {
        $orders = Order::orderBy('orders_id', 'desc')->get();
        return view('orders', compact('orders'));
    }

    public function myOrders()
    {
        $orders = Order::with(['produk', 'game'])
            ->where('user_id', Auth::id())
            ->orderBy('orders_id', 'desc')
            ->get();

        return view('my_orders', compact('orders'));
    }



}
