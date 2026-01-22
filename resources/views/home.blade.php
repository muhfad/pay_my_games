@extends('layouts.app')

@section('content')

<div class="space-y-12">
    {{-- HERO SECTION --}}
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl p-8 md:p-12 shadow-2xl">
        <div class="max-w-4xl mx-auto text-white">
            <div class="inline-flex items-center gap-2 bg-white/20 px-4 py-2 rounded-full text-sm font-bold mb-6">
                <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                Dipercaya 10,000+ Gamers
            </div>

            <h1 class="text-5xl md:text-6xl font-black mb-6">
                Top Up Game Tercepat & Termurah
            </h1>

            <p class="text-xl md:text-2xl mb-10 opacity-90">
                Nikmati pengalaman top up game yang mudah, cepat, dan aman dengan harga terbaik di Indonesia
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-2xl p-5 text-gray-900">
                    <div class="flex items-center gap-3">
                        <div class="bg-green-500 p-3 rounded-xl flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Instan</p>
                            <p class="text-sm text-gray-600">Proses 10 detik</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 text-gray-900">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-500 p-3 rounded-xl flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Aman</p>
                            <p class="text-sm text-gray-600">100% Terpercaya</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 text-gray-900">
                    <div class="flex items-center gap-3">
                        <div class="bg-purple-500 p-3 rounded-xl flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Harga Terbaik</p>
                            <p class="text-sm text-gray-600">Promo setiap hari</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION HEADER --}}
    <div class="text-center">
        <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-600 rounded-full text-sm font-bold mb-4">
            GAME POPULER
        </span>
        <h2 class="text-4xl font-black text-gray-900 mb-4">
            Pilih Game Favoritmu
        </h2>
        <p class="text-xl text-gray-600">
            Top up game favorit dengan harga terbaik, cepat, dan aman
        </p>
    </div>

    {{-- GAMES GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($games as $g)
        <a href="/game/{{ $g->games_id }}" class="group block">
            <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                <div class="relative h-56 overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-600">
                    @if($g->gambar)
                        <img src="{{ asset('storage/games/' . $g->gambar) }}" 
                             alt="{{ $g->nama_games }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white">
                            <div class="text-center">
                                <svg class="w-20 h-20 mx-auto mb-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path>
                                </svg>
                                <p class="font-bold">{{ $g->nama_games }}</p>
                            </div>
                        </div>
                    @endif

                    @if($g->status == 'aktif')
                        <div class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-3 py-2 rounded-full shadow-lg">
                            AKTIF
                        </div>
                    @else
                        <div class="absolute top-4 right-4 bg-gray-500 text-white text-xs font-bold px-3 py-2 rounded-full shadow-lg">
                            NON-AKTIF
                        </div>
                    @endif
                </div>

                <div class="p-6">
                    <h3 class="font-black text-xl text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">
                        {{ $g->nama_games }}
                    </h3>
                    <p class="text-sm text-gray-500 mb-4">
                        Top up resmi & terpercaya
                    </p>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div>
                            <p class="text-xs text-gray-500"></p>
                            <p class="text-lg font-black text-indigo-600"></p>
                        </div>
                        <div class="bg-indigo-600 text-white p-3 rounded-full group-hover:bg-indigo-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-full">
            <div class="bg-gray-100 rounded-3xl p-16 text-center border-2 border-dashed border-gray-300">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-700 mb-3">Belum Ada Game Tersedia</h3>
                <p class="text-gray-500 text-lg">Game akan segera ditambahkan</p>
            </div>
        </div>
        @endforelse
    </div>

    {{-- WHY CHOOSE US --}}
    <div class="bg-gray-50 rounded-3xl p-12">
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-600 rounded-full text-sm font-bold mb-4">
                KENAPA PILIH KAMI
            </span>
            <h2 class="text-4xl font-black text-gray-900 mb-4">
                Keunggulan Pay My Games
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all">
                <div class="bg-gradient-to-br from-indigo-500 to-purple-600 w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-3">Proses Super Cepat</h3>
                <p class="text-gray-600 leading-relaxed">
                    Top up langsung masuk ke akun game kamu dalam 10-30 detik saja
                </p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all">
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-3">100% Aman & Legal</h3>
                <p class="text-gray-600 leading-relaxed">
                    Sistem keamanan terjamin dengan enkripsi tingkat bank dan official reseller
                </p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all">
                <div class="bg-gradient-to-br from-purple-500 to-pink-600 w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-3">Harga Termurah</h3>
                <p class="text-gray-600 leading-relaxed">
                    Harga paling kompetitif dengan berbagai promo menarik setiap hari
                </p>
            </div>
        </div>
    </div>

    {{-- CTA SECTION --}}
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl p-12 text-center text-white">
        <h2 class="text-4xl font-black mb-4">
            Siap Top Up Game Favoritmu?
        </h2>
        <p class="text-xl mb-8 opacity-90">
            Join 10,000+ gamers yang sudah mempercayai kami
        </p>
        <a href="#" class="inline-flex items-center gap-3 bg-white text-indigo-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-100 transition-colors shadow-xl">
            <span>Mulai Top Up Sekarang</span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
        </a>
    </div>
</div>

@endsection