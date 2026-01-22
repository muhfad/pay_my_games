
@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">My Orders</h2>

<div class="bg-white shadow rounded">
<table class="w-full text-left">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">Game</th>
            <th class="p-2">Produk</th>
            <th class="p-2">Total</th>
            <th class="p-2">Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $o)
        <tr class="border-t">
            <td class="p-2">{{ $o->game->nama_games ?? '-' }}</td>
            <td class="p-2">{{ $o->produk->nama_produk }}</td>
            <td class="p-2">Rp {{ number_format($o->jumlah_bayar) }}</td>
            <td class="p-2 space-x-2">
                <!-- STATUS -->
                <span class="px-2 py-1 rounded text-white text-sm
                    @if($o->status_orders == 'success') bg-green-600
                    @elseif($o->status_orders == 'paid') bg-blue-600
                    @else bg-yellow-500
                    @endif">
                    {{ $o->status_orders }}
                </span>

                <!-- TOMBOL BAYAR -->
                @if($o->status_orders == 'pending')
                    <a href="/payment/{{ $o->orders_id }}"
                    class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                        Bayar
                    </a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection

