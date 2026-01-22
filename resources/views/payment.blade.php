@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Pembayaran</h2>

    {{-- DETAIL ORDER --}}
    <div class="bg-white shadow rounded p-6 mb-6">
        <h3 class="font-semibold text-lg mb-4 border-b pb-2">Detail Pesanan</h3>
        
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-gray-600">Order ID:</span>
                <span class="font-semibold">#{{ $order->orders_id }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Game:</span>
                <span class="font-semibold">{{ $order->game->nama_games ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Produk:</span>
                <span class="font-semibold">{{ $order->produk->nama_produk ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">User Game ID:</span>
                <span class="font-semibold">{{ $order->user_game_id ?? '-' }}</span>
            </div>
            <div class="flex justify-between border-t pt-2 mt-2">
                <span class="text-gray-600">Harga:</span>
                <span>Rp {{ number_format($order->jumlah_bayar - $order->kode_unik) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Kode Unik:</span>
                <span>Rp {{ number_format($order->kode_unik) }}</span>
            </div>
            <div class="flex justify-between border-t pt-2 mt-2">
                <span class="text-lg font-bold">Total Pembayaran:</span>
                <span class="text-lg font-bold text-green-600">
                    Rp {{ number_format($order->jumlah_bayar) }}
                </span>
            </div>
        </div>
    </div>

    {{-- METODE PEMBAYARAN --}}
    <div class="bg-white shadow rounded p-6">
        <h3 class="font-semibold text-lg mb-4 border-b pb-2">Metode Pembayaran - Transfer Bank</h3>
        
        <p class="text-sm text-gray-600 mb-4">
            Silakan transfer ke salah satu rekening berikut dengan <b>NOMINAL EXACT</b>
        </p>

        {{-- BCA --}}
        <div class="border rounded p-4 mb-3 hover:bg-blue-50 transition">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-16 h-10 bg-blue-600 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-sm">BCA</span>
                    </div>
                    <div>
                        <p class="font-semibold">Bank BCA</p>
                        <p class="text-sm text-gray-600">a.n. Top Up Store</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-mono font-bold text-lg">1234567890</p>
                    <button onclick="copyToClipboard('1234567890')" 
                            class="text-xs text-blue-600 hover:underline">
                        Salin
                    </button>
                </div>
            </div>
        </div>

        {{-- BNI --}}
        <div class="border rounded p-4 mb-3 hover:bg-orange-50 transition">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-16 h-10 bg-orange-500 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-sm">BNI</span>
                    </div>
                    <div>
                        <p class="font-semibold">Bank BNI</p>
                        <p class="text-sm text-gray-600">a.n. Top Up Store</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-mono font-bold text-lg">0987654321</p>
                    <button onclick="copyToClipboard('0987654321')" 
                            class="text-xs text-orange-600 hover:underline">
                        Salin
                    </button>
                </div>
            </div>
        </div>

        {{-- BSI --}}
        <div class="border rounded p-4 mb-3 hover:bg-green-50 transition">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-16 h-10 bg-green-600 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-sm">BSI</span>
                    </div>
                    <div>
                        <p class="font-semibold">Bank BSI</p>
                        <p class="text-sm text-gray-600">a.n. Top Up Store</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-mono font-bold text-lg">1122334455</p>
                    <button onclick="copyToClipboard('1122334455')" 
                            class="text-xs text-green-600 hover:underline">
                        Salin
                    </button>
                </div>
            </div>
        </div>

        {{-- BRI --}}
        <div class="border rounded p-4 mb-4 hover:bg-blue-50 transition">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-16 h-10 bg-blue-700 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-sm">BRI</span>
                    </div>
                    <div>
                        <p class="font-semibold">Bank BRI</p>
                        <p class="text-sm text-gray-600">a.n. Top Up Store</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-mono font-bold text-lg">5544332211</p>
                    <button onclick="copyToClipboard('5544332211')" 
                            class="text-xs text-blue-700 hover:underline">
                        Salin
                    </button>
                </div>
            </div>
        </div>

        {{-- INSTRUKSI --}}
        <div class="bg-yellow-50 border border-yellow-200 rounded p-4 mb-4">
            <p class="font-semibold text-sm mb-2">⚠️ Penting:</p>
            <ul class="text-sm space-y-1 ml-4 list-disc text-gray-700">
                <li>Transfer dengan <b>nominal exact</b> sesuai total pembayaran di atas</li>
                <li>Kode unik berfungsi untuk verifikasi otomatis</li>
                <li>Simpan bukti transfer untuk keperluan konfirmasi</li>
                <li>Proses verifikasi maksimal 1x24 jam</li>
            </ul>
        </div>

        {{-- FORM KONFIRMASI --}}
        <form action="/payment/{{ $order->orders_id }}" method="POST">
            @csrf
            <button type="submit"
                    class="w-full bg-green-600 text-white py-3 rounded-lg 
                           hover:bg-green-700 transition font-semibold">
                Saya Sudah Transfer
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="/my-orders" class="text-sm text-gray-600 hover:text-blue-600">
                ← Kembali ke My Orders
            </a>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Nomor rekening berhasil disalin: ' + text);
    }, function(err) {
        alert('Gagal menyalin nomor rekening');
    });
}
</script>

<style>
@media print {
    button, a {
        display: none;
    }
}
</style>
@endsection