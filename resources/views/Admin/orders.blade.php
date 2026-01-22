@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-800">Manajemen Order</h2>
    <p class="text-gray-600 mt-1">Kelola semua pesanan top up game</p>
</div>

{{-- NOTIFIKASI --}}
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex items-center justify-between">
    <span>{{ session('success') }}</span>
    <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">✕</button>
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex items-center justify-between">
    <span>{{ session('error') }}</span>
    <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">✕</button>
</div>
@endif

{{-- FILTER & SEARCH --}}
<div class="bg-white shadow rounded-lg p-4 mb-6">
    <form method="GET" action="/admin/orders" class="flex flex-wrap gap-4 items-end">
        {{-- Search --}}
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Order ID, Nama User, Game..."
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
        </div>

        {{-- Filter Status --}}
        <div class="min-w-[180px]">
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="w-full border border-gray-300 rounded-lg px-10 py-2.5 pr- focus:ring-2 focus:ring-indigo-500 focus:outline-none bg-white appearance-none" style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 0.5rem center; background-size: 1.5em 1.5em;">
                <option value="">Semua</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success</option>
                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
            </select>
        </div>

        {{-- Buttons --}}
        <div class="flex gap-2">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                Filter
            </button>
            <a href="/admin/orders" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Reset
            </a>
        </div>
    </form>
</div>

{{-- STATISTIK --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white shadow rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Orders</p>
                <p class="text-2xl font-bold text-gray-800">{{ $orders->count() }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <span class="text-sm font-semibold text-blue-700">ALL</span>
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Pending</p>
                <p class="text-2xl font-bold text-yellow-600">{{ $orders->where('status_orders', 'pending')->count() }}</p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <span class="text-sm font-semibold text-yellow-700">PND</span>
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Success</p>
                <p class="text-2xl font-bold text-green-600">{{ $orders->where('status_orders', 'success')->count() }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <span class="text-sm font-semibold text-green-700">OK</span>
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Failed</p>
                <p class="text-2xl font-bold text-red-600">{{ $orders->where('status_orders', 'failed')->count() }}</p>
            </div>
            <div class="bg-red-100 p-3 rounded-full">
                <span class="text-sm font-semibold text-red-700">FAIL</span>
            </div>
        </div>
    </div>
</div>

{{-- TABEL ORDERS --}}
<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Order ID</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">User</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Game</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Produk</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">User Game ID</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Total</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($orders as $o)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-sm font-mono">#{{ $o->orders_id }}</td>
                    <td class="px-4 py-3 text-sm">
                        <div class="font-medium text-gray-900">{{ $o->user->name ?? '-' }}</div>
                        <div class="text-gray-500 text-xs">{{ $o->user->email ?? '-' }}</div>
                    </td>
                    <td class="px-4 py-3 text-sm">{{ $o->game->nama_games ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm">{{ $o->produk->nama_produk ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm font-mono">{{ $o->user_game_id ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm font-semibold">Rp {{ number_format($o->jumlah_bayar) }}</td>
                    <td class="px-4 py-3 text-sm">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($o->status_orders == 'success') bg-green-100 text-green-800
                            @elseif($o->status_orders == 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($o->status_orders) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($o->tanggal_orders)->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col gap-2 min-w-[180px]">
                            {{-- Detail Button --}}
                            <button onclick="showDetail({{ $o->orders_id }})" 
                                    class="bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 
                                           transition-all text-base font-semibold shadow-sm hover:shadow-md">
                                LIHAT DETAIL
                            </button>

                            {{-- Update Status Buttons --}}
                            @if($o->status_orders == 'pending')
                                <button onclick="updateStatus({{ $o->orders_id }}, 'success')"
                                        class="bg-green-600 text-white px-5 py-2.5 rounded-lg hover:bg-green-700 
                                               transition-all text-base font-semibold shadow-sm hover:shadow-md">
                                    APPROVE
                                </button>
                                <button onclick="updateStatus({{ $o->orders_id }}, 'failed')"
                                        class="bg-orange-600 text-white px-5 py-2.5 rounded-lg hover:bg-orange-700 
                                               transition-all text-base font-semibold shadow-sm hover:shadow-md">
                                    TOLAK
                                </button>
                            @elseif($o->status_orders == 'failed')
                                <button onclick="updateStatus({{ $o->orders_id }}, 'success')"
                                        class="bg-green-600 text-white px-5 py-2.5 rounded-lg hover:bg-green-700 
                                               transition-all text-base font-semibold shadow-sm hover:shadow-md">
                                    SET SUCCESS
                                </button>
                                <button onclick="updateStatus({{ $o->orders_id }}, 'pending')"
                                        class="bg-yellow-600 text-white px-5 py-2.5 rounded-lg hover:bg-yellow-700 
                                               transition-all text-base font-semibold shadow-sm hover:shadow-md">
                                    SET PENDING
                                </button>
                            @elseif($o->status_orders == 'success')
                                <button onclick="updateStatus({{ $o->orders_id }}, 'pending')"
                                        class="bg-yellow-600 text-white px-5 py-2.5 rounded-lg hover:bg-yellow-700 
                                               transition-all text-base font-semibold shadow-sm hover:shadow-md">
                                    SET PENDING
                                </button>
                                <button onclick="updateStatus({{ $o->orders_id }}, 'failed')"
                                        class="bg-orange-600 text-white px-5 py-2.5 rounded-lg hover:bg-orange-700 
                                               transition-all text-base font-semibold shadow-sm hover:shadow-md">
                                    SET FAILED
                                </button>
                            @endif

                            {{-- Delete Button --}}
                            <button onclick="confirmDelete({{ $o->orders_id }})" 
                                    class="bg-red-600 text-white px-5 py-2.5 rounded-lg hover:bg-red-700 
                                           transition-all text-base font-semibold shadow-sm hover:shadow-md border-2 border-red-700">
                                HAPUS ORDER
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                        <div class="text-lg mb-2 font-semibold">Tidak ada data</div>
                        <p>Tidak ada order yang ditemukan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL DETAIL ORDER --}}
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4 border-b pb-4">
                <h3 class="text-xl font-bold text-gray-800">Detail Order</h3>
                <button onclick="closeDetail()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            <div id="detailContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
// Show Detail Modal
function showDetail(orderId) {
    const order = @json($orders);
    const selectedOrder = order.find(o => o.orders_id === orderId);
    
    if (!selectedOrder) return;
    
    const content = `
        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Order ID</p>
                    <p class="font-semibold">#${selectedOrder.orders_id}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Tanggal Order</p>
                    <p class="font-semibold">${new Date(selectedOrder.tanggal_orders).toLocaleString('id-ID')}</p>
                </div>
            </div>
            
            <hr>
            
            <div>
                <p class="text-sm text-gray-600">Nama User</p>
                <p class="font-semibold">${selectedOrder.user?.name || '-'}</p>
            </div>
            
            <div>
                <p class="text-sm text-gray-600">Email User</p>
                <p class="font-semibold">${selectedOrder.user?.email || '-'}</p>
            </div>
            
            <hr>
            
            <div>
                <p class="text-sm text-gray-600">Game</p>
                <p class="font-semibold">${selectedOrder.game?.nama_games || '-'}</p>
            </div>
            
            <div>
                <p class="text-sm text-gray-600">Produk</p>
                <p class="font-semibold">${selectedOrder.produk?.nama_produk || '-'}</p>
            </div>
            
            <div>
                <p class="text-sm text-gray-600">User Game ID</p>
                <p class="font-semibold font-mono">${selectedOrder.user_game_id || '-'}</p>
            </div>
            
            <hr>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Harga Produk</p>
                    <p class="font-semibold">Rp ${(selectedOrder.jumlah_bayar - selectedOrder.kode_unik).toLocaleString('id-ID')}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kode Unik</p>
                    <p class="font-semibold">Rp ${selectedOrder.kode_unik?.toLocaleString('id-ID') || 0}</p>
                </div>
            </div>
            
            <div>
                <p class="text-sm text-gray-600">Total Pembayaran</p>
                <p class="font-bold text-xl text-green-600">Rp ${selectedOrder.jumlah_bayar?.toLocaleString('id-ID')}</p>
            </div>
            
            <div>
                <p class="text-sm text-gray-600">Status</p>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold mt-1
                    ${selectedOrder.status_orders === 'success' ? 'bg-green-100 text-green-800' : 
                      selectedOrder.status_orders === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                      'bg-red-100 text-red-800'}">
                    ${selectedOrder.status_orders.charAt(0).toUpperCase() + selectedOrder.status_orders.slice(1)}
                </span>
            </div>
        </div>
    `;
    
    document.getElementById('detailContent').innerHTML = content;
    document.getElementById('detailModal').classList.remove('hidden');
}

function closeDetail() {
    document.getElementById('detailModal').classList.add('hidden');
}

// Update Status
function updateStatus(orderId, status) {
    let statusText = status === 'success' ? 'SUCCESS' : status === 'failed' ? 'FAILED' : 'PENDING';
    
    if (confirm(`Apakah Anda yakin ingin mengubah status order #${orderId} menjadi "${statusText}"?`)) {
        window.location.href = `/admin/orders/${orderId}/${status}`;
    }
}

// Delete Order
function confirmDelete(orderId) {
    if (confirm(`PERHATIAN!\n\nApakah Anda yakin ingin menghapus order #${orderId}?\n\nTindakan ini tidak dapat dibatalkan!`)) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/orders/${orderId}/delete`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}

// Close modal when clicking outside
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDetail();
    }
});
</script>
@endsection