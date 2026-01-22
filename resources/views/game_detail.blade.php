@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif
    
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- JUDUL --}}
    <h2 class="text-2xl font-bold mb-6">{{ $game->nama_games }}</h2>

    {{-- INPUT USER GAME ID --}}
    <div class="bg-white p-4 rounded shadow mb-6">
        <label class="block text-sm font-medium mb-2">
            User ID / Game ID <span class="text-red-500">*</span>
        </label>
        <input 
            type="text" 
            id="userGameId"
            class="w-full border border-gray-300 rounded px-3 py-2 
                   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Masukkan User ID atau Game ID Anda"
            required>
        <p class="text-xs text-gray-500 mt-1">
            Masukkan ID akun game Anda untuk proses top up
        </p>
    </div>

    {{-- PRODUK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($produk as $p)
            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-semibold text-lg">{{ $p->nama_produk }}</h3>
                <p class="text-gray-600 mb-3">
                    Rp {{ number_format($p->harga) }}
                </p>

                <form action="/topup" method="POST" class="topup-form">
                    @csrf
                    <input type="hidden" name="produk_id" value="{{ $p->produk_id }}">
                    <input type="hidden" name="user_game_id" class="user-game-id-input">
                    <button
                        type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded
                               hover:bg-green-700 w-full">
                        Beli Sekarang
                    </button>
                </form>
            </div>
        @endforeach
    </div>

    {{-- TOMBOL KEMBALI --}}
    <div class="mt-6">
        <a href="/"
           class="inline-flex items-center text-sm text-gray-600
                  hover:text-blue-600">
            ← Kembali ke daftar game
        </a>
    </div>

</div>

<script>
    // Validasi dan copy user_game_id ke semua form
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('.topup-form');
        const userGameIdInput = document.getElementById('userGameId');
        
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const userGameId = userGameIdInput.value.trim();
                
                if (!userGameId) {
                    e.preventDefault();
                    alert('Silakan masukkan User ID / Game ID terlebih dahulu!');
                    userGameIdInput.focus();
                    return false;
                }
                
                // Copy value ke hidden input di form yang di-submit
                const hiddenInput = form.querySelector('.user-game-id-input');
                hiddenInput.value = userGameId;
            });
        });
    });
</script>
@endsection