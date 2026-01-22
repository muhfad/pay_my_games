<h2>Admin - Semua Order</h2>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="5">
<tr>
    <th>User</th>
    <th>Game</th>
    <th>Produk</th>
    <th>Total</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

@foreach($orders as $o)
<tr>
    <td>{{ $o->user->name }}</td>
    <td>{{ $o->game->nama_games }}</td>
    <td>{{ $o->produk->nama_produk }}</td>
    <td>Rp {{ number_format($o->jumlah_bayar) }}</td>
    <td>{{ $o->status_orders }}</td>
    <td>
        <a href="/admin/orders/{{ $o->orders_id }}/paid">Paid</a> |
        <a href="/admin/orders/{{ $o->orders_id }}/success">Success</a>
    </td>
</tr>
@endforeach
</table>
