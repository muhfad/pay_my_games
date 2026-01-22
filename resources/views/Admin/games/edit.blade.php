@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Edit Game</h2>
        <p class="text-gray-600 mt-1">Update informasi game</p>
    </div>

    {{-- FORM --}}
    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="/admin/games/{{ $game->games_id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama Game --}}
            <div class="mb-6">
                <label for="nama_games" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Game <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="nama_games" 
                       id="nama_games"
                       value="{{ old('nama_games', $game->nama_games) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                       required>
                @error('nama_games')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-6">
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status" 
                        id="status"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required>
                    <option value="aktif" {{ old('status', $game->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $game->status) == 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Gambar Saat Ini --}}
            @if($game->gambar)
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Gambar Saat Ini
                </label>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/games/' . $game->gambar) }}" 
                         alt="{{ $game->nama_games }}"
                         class="w-40 h-40 object-cover rounded-lg shadow-lg">
                    <div>
                        <p class="text-sm text-gray-600 mb-2">{{ $game->gambar }}</p>
                        <p class="text-xs text-gray-500">Upload gambar baru untuk mengganti</p>
                    </div>
                </div>
            </div>
            @endif

            {{-- Upload Gambar Baru --}}
            <div class="mb-6">
                <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">
                    Upload Gambar Baru (Opsional)
                </label>
                <div class="flex items-center gap-4">
                    <label for="gambar" class="cursor-pointer">
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-indigo-500 transition text-center">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="text-sm text-gray-600 mb-1">Klik untuk upload</p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF (Max 2MB)</p>
                        </div>
                        <input type="file" 
                               name="gambar" 
                               id="gambar"
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(event)">
                    </label>

                    {{-- Preview Image --}}
                    <div id="preview-container" class="hidden">
                        <img id="preview-image" 
                             src="" 
                             alt="Preview"
                             class="w-40 h-40 object-cover rounded-lg shadow-lg">
                    </div>
                </div>
                @error('gambar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex gap-4 pt-6 border-t">
                <button type="submit" 
                        class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold shadow-lg">
                    Update Game
                </button>
                <a href="/admin/games" 
                   class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition font-semibold text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('preview-container').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection