@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-800">Manajemen Game</h2>
    <p class="text-gray-600 mt-1">Kelola semua game yang tersedia</p>
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

{{-- BUTTON TAMBAH --}}
<div class="mb-6">
    <a href="/admin/games/create" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold shadow-lg">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Game Baru
    </a>
</div>

{{-- TABEL GAMES --}}
<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Gambar</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Game</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($games as $game)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm font-mono">{{ $game->games_id }}</td>
                    <td class="px-6 py-4">
                        @if($game->gambar)
                            <img src="{{ asset('storage/games/' . $game->gambar) }}" 
                                 alt="{{ $game->nama_games }}"
                                 class="w-20 h-20 object-cover rounded-lg shadow">
                        @else
                            <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path>
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-900">{{ $game->nama_games }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($game->status == 'aktif')
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                Aktif
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                Non-aktif
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="/admin/games/{{ $game->games_id }}/edit" 
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                                Edit
                            </a>
                            <button onclick="confirmDelete({{ $game->games_id }})" 
                                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition text-sm font-semibold">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <div class="text-lg font-semibold mb-2">Belum ada game</div>
                        <p>Klik tombol "Tambah Game Baru" untuk menambahkan game</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmDelete(gameId) {
    if (confirm('PERHATIAN!\n\nApakah Anda yakin ingin menghapus game ini?\n\nSemua produk terkait game ini juga akan terpengaruh!')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/games/${gameId}`;
        
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
</script>
@endsection